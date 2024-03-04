<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Customer::with(['team'])->select(sprintf('%s.*', (new Customer())->table));
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $viewGate = 'customer_show';
                $editGate = 'customer_edit';
                $deleteGate = 'customer_delete';
                $crudRoutePart = 'customers';
                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });

            $table->addColumn('cus_details', function ($row) {
                if(empty($row->profile))
                {
                     $imgData='<div class="avatar-wrapper">
                        <div class="avatar bg-light-success mr-50">
                        <a href="'.asset("public/logo.png").'" target="_blank" style="display: inline-block">
                        <img class="" src="'.asset("public/logo.png").'" width="42" height="42" alt="img" />
                        </a>
                        </div>
                    </div>';
                }else{
                    $imgData='<div class="avatar-wrapper">
                        <div class="avatar bg-light-success mr-50">
                        <a href="'.($row->profile ? $row->profile->getUrl() : '#').'" target="_blank" style="display: inline-block">
                        <img class="" src="'.($row->profile ? $row->profile->getUrl('thumb') : '').'" width="42" height="42" alt="img" />
                        </a>
                        </div>
                    </div>';
                }
                return '<div class="d-flex justify-content-left align-items-center">
                    '.$imgData.'
                    <div class="d-flex flex-column" style="margin-left:1px;">
                    <h6 class="user-name text-truncate mb-0">'.($row->name ? $row->name : '').'</h6>
                    <small class="text-truncate">'.($row->email ? $row->email : '').'</small>
                    <small>'.($row->phone!='' ? getNum1($row->phone) : '').'</small>
                    </div>
                </div>';
            });     
            $table->editColumn('status', function ($row) {
                return '<div class="custom-control custom-switch custom-switch-success">
                            <input type="checkbox" data-id="'.$row->id.'" class="custom-control-input status_index" ' . ($row->status==1 ? 'checked' : null) . ' id="customSwitch_'.$row->id.'"/>
                            <label class="custom-control-label" for="customSwitch_'.$row->id.'">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                            </div>';
            });
            $table->rawColumns(['actions', 'placeholder','status','cus_details']);
            return $table->make(true);
        }
        return view('admin.customers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        if ($request->input('profile', false)) {
            $customer->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile'))))->toMediaCollection('profile');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $customer->id]);
        }

        return redirect()->route('admin.customers.index');
    }

    public function edit(Customer $customer)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->load('team');

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());

        if ($request->input('profile', false)) {
            if (!$customer->profile || $request->input('profile') !== $customer->profile->file_name) {
                if ($customer->profile) {
                    $customer->profile->delete();
                }
                $customer->addMedia(storage_path('tmp/uploads/' . basename($request->input('profile'))))->toMediaCollection('profile');
            }
        } elseif ($customer->profile) {
            $customer->profile->delete();
        }

        return redirect()->route('admin.customers.index');
    }

    public function show(Customer $customer)
    {
        abort_if(Gate::denies('customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->load('team');

        return view('admin.customers.show', compact('customer'));
    }

    public function destroy(Customer $customer)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer->delete();

        return back();
    }

    public function massDestroy(MassDestroyCustomerRequest $request)
    {
        Customer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('customer_create') && Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Customer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    public function update_status(Request $request)
    {
        DB::table($request->modal_name)->where('id', $request->record_id)->update(array($request->field_name => $request->status)); 
        return response()->json(['result' => '1'], Response::HTTP_CREATED);
    }
}
