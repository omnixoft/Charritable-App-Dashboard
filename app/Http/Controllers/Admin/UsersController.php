<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = User::with(['roles', 'team'])->select(sprintf('%s.*', (new User())->table));
            $table = Datatables::of($query);
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';
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
            $table->addColumn('u_details', function ($row) {
                return '<div class="d-flex flex-column" style="margin-left:1px;">
                    <h6 class="user-name text-truncate mb-0">'.(isset($row->name) ? $row->name : '').'</h6>
                    <small class="text-truncate text-info">'.(isset($row->email) ? $row->email : '').'</small>
                    </div>
                </div>';
            }); 
            $table->editColumn('two_factor', function ($row) {
                return '<div class="custom-control custom-switch custom-switch-success">
                            <input type="checkbox" data-id="'.$row->id.'" class="custom-control-input status_index2" ' . is_check($row->two_factor) . ' id="customSwitch2_'.$row->id.'"/>
                            <label class="custom-control-label" for="customSwitch2_'.$row->id.'">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                            </div>';
            });            
            
            $table->editColumn('verified', function ($row) {
                return '<div class="custom-control custom-switch custom-switch-success">
                            <input type="checkbox" data-id="'.$row->id.'" class="custom-control-input status_index3" ' . is_check($row->verified) . ' id="customSwitch3_'.$row->id.'"/>
                            <label class="custom-control-label" for="customSwitch3_'.$row->id.'">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                            </div>';
            });            

            $table->editColumn('approved', function ($row) {
                return '<div class="custom-control custom-switch custom-switch-success">
                            <input type="checkbox" data-id="'.$row->id.'" class="custom-control-input status_index" ' . is_check($row->approved) . ' id="customSwitch_'.$row->id.'"/>
                            <label class="custom-control-label" for="customSwitch_'.$row->id.'">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                            </div>';
            });            
            $table->addColumn('c_details', function ($row) {
                return '<div class="d-flex flex-column" style="margin-left:1px;">
                    <h6 class="user-name text-truncate mb-0">'.(isset($row->team->name) ? $row->team->name : '').'</h6>
                    <small class="text-truncate text-info">'.(isset($row->team->name_ar) ? $row->team->name_ar : '').'</small>
                    </div>
                </div>';
            }); 

            $table->editColumn('roles', function ($row) {
                $labels = [];
                foreach ($row->roles as $role) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $role->title);
                }
                return implode(' ', $labels);
            });
            $table->rawColumns(['actions','u_details', 'placeholder', 'two_factor', 'approved', 'c_details', 'verified', 'roles']);
            return $table->make(true);
        }
        return view('admin.users.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.users.create', compact('roles', 'teams'));
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $team = Team::find($data["team_id"]);
        
        $user = User::create($data);
        if($team){
            $team->owner_id = $user->id;
            $team->save();
        }
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('title', 'id');

        $teams = Team::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $user->load('roles', 'team');

        return view('admin.users.edit', compact('roles', 'teams', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        // $user->update($request->all());
        $data = $request->all();
        $team = Team::find($data["team_id"]);
        
        $user->update($data);
        if($team){
            $team->owner_id = $user->id;
            $team->save();
        }
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('roles', 'team', 'userUserAlerts');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
