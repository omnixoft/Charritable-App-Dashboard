<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySocialSolidarityRequest;
use App\Http\Requests\StoreSocialSolidarityRequest;
use App\Http\Requests\UpdateSocialSolidarityRequest;
use App\Models\Donationtype;
use App\Models\SocialSolidarity;
use App\Models\Team;
use App\Models\Donation;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SocialSolidarityController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('social_solidarity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if ($request->ajax()) {
            $query = SocialSolidarity::with(['donation_type', 'team'])->select(sprintf('%s.*', (new SocialSolidarity())->table));
            if(auth()->user()->roles[0]->id!=1){
                $id =auth()->user()->team_id;
                $query =  $query->where("team_id",$id);
            }
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('amount', function ($row) {
                $donations = Donation::where("social_solidarity_id",$row->id)->get();
                if(!$donations->isEmpty()){
                    $num = $donations->sum("amount");
                }else{
                    $num = 0;
                }
                return getOmr($num);
            });
            $table->editColumn('actions', function ($row) {
                $viewGate = 'social_solidarity_show';
                $editGate = 'social_solidarity_edit';
                $deleteGate = 'social_solidarity_delete';
                $crudRoutePart = 'social-solidarities';

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

            $table->addColumn('social_details', function ($row) {
                return '<div class="d-flex flex-column" style="margin-left:1px;">
                    <h6 class="user-name text-truncate mb-0">'.($row->title ? $row->title : '').'</h6>
                    <small class="text-truncate text-info">'.($row->title_ar ? $row->title_ar : '').'</small>
                    </div>
                </div>';
            });


            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('description_ar', function ($row) {
                return $row->description_ar ? $row->description_ar : '';
            });
            $table->editColumn('images_and_videos', function ($row) {
                if (!$row->images_and_videos) {
                    return '';
                }
                $links = [];
                foreach ($row->images_and_videos as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->addColumn('donation_type_type', function ($row) {
                return $row->donation_type ? $row->donation_type->type : '';
            });

            $table->addColumn('target_amount', function ($row) {
                return $row->target_amount!='' ? getOmr($row->target_amount) : '';
            });
            $table->editColumn('active', function ($row) {
                return '<div class="custom-control custom-switch custom-switch-success">
                            <input type="checkbox" data-id="'.$row->id.'" class="custom-control-input status_index" ' . ($row->active==1 ? 'checked' : null) . ' id="customSwitch_'.$row->id.'"/>
                            <label class="custom-control-label" for="customSwitch_'.$row->id.'">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                            </div>';
            });    

            $table->rawColumns(['actions','social_details', 'placeholder', 'images_and_videos', 'donation_type','target_amount','active']);

            return $table->make(true);
        }

        return view('admin.socialSolidarities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('social_solidarity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donation_types = Donationtype::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');
        $charity = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.socialSolidarities.create', compact('donation_types','charity'));
    }

    public function store(StoreSocialSolidarityRequest $request)
    {
        $socialSolidarity = SocialSolidarity::create($request->all());

        foreach ($request->input('images_and_videos', []) as $file) {
            $socialSolidarity->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images_and_videos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $socialSolidarity->id]);
        }

        return redirect()->route('admin.social-solidarities.index');
    }

    public function edit(SocialSolidarity $socialSolidarity)
    {
        abort_if(Gate::denies('social_solidarity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donation_types = Donationtype::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $charity = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $socialSolidarity->load('donation_type', 'team');

        return view('admin.socialSolidarities.edit', compact('donation_types', 'socialSolidarity',"charity"));
    }

    public function update(UpdateSocialSolidarityRequest $request, SocialSolidarity $socialSolidarity)
    {
        $socialSolidarity->update($request->all());

        if (count($socialSolidarity->images_and_videos) > 0) {
            foreach ($socialSolidarity->images_and_videos as $media) {
                if (!in_array($media->file_name, $request->input('images_and_videos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $socialSolidarity->images_and_videos->pluck('file_name')->toArray();
        foreach ($request->input('images_and_videos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $socialSolidarity->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images_and_videos');
            }
        }

        return redirect()->route('admin.social-solidarities.index');
    }

    public function show(SocialSolidarity $socialSolidarity)
    {
        abort_if(Gate::denies('social_solidarity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialSolidarity->load('donation_type', 'team');

        return view('admin.socialSolidarities.show', compact('socialSolidarity'));
    }

    public function destroy(SocialSolidarity $socialSolidarity)
    {
        abort_if(Gate::denies('social_solidarity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $socialSolidarity->delete();

        return back();
    }

    public function massDestroy(MassDestroySocialSolidarityRequest $request)
    {
        SocialSolidarity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('social_solidarity_create') && Gate::denies('social_solidarity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SocialSolidarity();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
