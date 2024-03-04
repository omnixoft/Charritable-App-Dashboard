<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTeamRequest;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Donationtype;
use App\Models\Governorate;
use App\Models\Team;
use App\Models\Donation;
use App\Models\Wilayat;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('team_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Team::with(['governorate', 'wilayat', 'type_of_donations', 'owner'])->select(sprintf('%s.*', (new Team())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'team_show';
                $editGate = 'team_edit';
                $deleteGate = 'team_delete';
                $crudRoutePart = 'teams';

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
            // $table->editColumn('total', function ($row) {
            //     return $row->id ? $row->id : '';
            // });
            $table->editColumn('donation', function ($row) {
                $donations = Donation::where("company_id",$row->id)->get();
                if(!$donations->isEmpty()){
                    $num = $donations->sum("amount");
                }else{
                    $num = 0;
                }
                return getOmr($num);
            });
            $table->addColumn('cus_details', function ($row) {
                if(empty($row->logo))
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
                        <a href="'.($row->logo ? $row->logo->getUrl() : '#').'" target="_blank" style="display: inline-block">
                        <img class="" src="'.($row->logo ? $row->logo->getUrl('thumb') : '').'" width="42" height="42" alt="img" />
                        </a>
                        </div>
                    </div>';
                }
                return '<div class="d-flex justify-content-left align-items-center">
                    '.$imgData.'
                    <div class="d-flex flex-column" style="margin-left:1px;">
                    <h6 class="user-name text-truncate mb-0">'.($row->name ? $row->name : '').'</h6>
                    <small class="text-truncate text-info">'.($row->name_ar ? $row->name_ar : '').'</small>
                    </div>
                </div>';
            });             
            $table->editColumn('type_of_donations', function ($row) {
                $labels = [];
                foreach ($row->type_of_donations as $type_of_donation) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $type_of_donation->type);
                }
                return implode(' ', $labels);
            });
            $table->addColumn('contact_details', function ($row) {
                if($row->owner){

                
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
                            <a href="'.($row->owner->profile ? $row->owner->logo->getUrl() : '#').'" target="_blank" style="display: inline-block">
                            <img class="" src="'.($row->owner->profile ? $row->profile->getUrl('thumb') : '').'" width="42" height="42" alt="img" />
                            </a>
                            </div>
                        </div>';
                    }
                    return '<div class="d-flex justify-content-left align-items-center">
                        '.$imgData.'
                        <div class="d-flex flex-column" style="margin-left:1px;">
                        <h6 class="user-name text-truncate mb-0">'.(isset($row->owner->name) ? $row->owner->name : '').'</h6>
                        <small class="text-truncate text-info">'.(isset($row->owner->email) ? $row->owner->email : '').'</small>
                        </div>
                    </div>';
            }
            });
            $table->editColumn('active', function ($row) {
                return $row->active ? Team::ACTIVE_RADIO[$row->active] : '';
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
            $table->rawColumns(['actions', 'placeholder','cus_details','contact_details','type_of_donations','active']);
            return $table->make(true);
        }
        return view('admin.teams.index');
    }

    public function create()
    {
        abort_if(Gate::denies('team_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governorates = Governorate::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wilayats = Wilayat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $type_of_donations = Donationtype::pluck('type', 'id');

        return view('admin.teams.create', compact('governorates', 'type_of_donations', 'wilayats'));
    }

    public function store(StoreTeamRequest $request)
    {
        $data             = $request->all();
        // $data['owner_id'] = auth()->user()->id;
        $team             = Team::create($data);
        $team->type_of_donations()->sync($request->input('type_of_donations', []));
        if ($request->input('logo', false)) {
            $team->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        foreach ($request->input('images', []) as $file) {
            $team->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $team->id]);
        }

        return redirect()->route('admin.teams.index');
    }

    public function edit(Team $team)
    {
        abort_if(Gate::denies('team_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governorates = Governorate::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wilayats = Wilayat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $type_of_donations = Donationtype::pluck('type', 'id');

        $team->load('governorate', 'wilayat', 'type_of_donations', 'owner');

        return view('admin.teams.edit', compact('governorates', 'team', 'type_of_donations', 'wilayats'));
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->all());
        $team->type_of_donations()->sync($request->input('type_of_donations', []));
        if ($request->input('logo', false)) {
            if (!$team->logo || $request->input('logo') !== $team->logo->file_name) {
                if ($team->logo) {
                    $team->logo->delete();
                }
                $team->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($team->logo) {
            $team->logo->delete();
        }

        if (count($team->images) > 0) {
            foreach ($team->images as $media) {
                if (!in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $team->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $team->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        return redirect()->route('admin.teams.index');
    }

    public function show(Team $team)
    {
        abort_if(Gate::denies('team_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team->load('governorate', 'wilayat', 'type_of_donations', 'owner');

        return view('admin.teams.show', compact('team'));
    }

    public function destroy(Team $team)
    {
        abort_if(Gate::denies('team_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $team->delete();

        return back();
    }

    public function massDestroy(MassDestroyTeamRequest $request)
    {
        Team::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('team_create') && Gate::denies('team_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Team();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
