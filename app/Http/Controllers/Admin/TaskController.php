<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskTag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Gate;
use DB;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tasks = Task::withTrashed()->with(['status', 'tags', 'assigned_to', 'media']);
        if(auth()->user()->id!=1 OR auth()->user()->team_id!=''){
            $tasks->where("team_id",auth()->user()->team_id);
        }
        
        if(isset($_GET["status"]) && $_GET["status"]==1){
        }
        
        if(isset($_GET["status"]) && $_GET["status"]==2){
            $tasks->where("assigned_to_id", Auth::id());
        }
        
        if(isset($_GET["status"]) && $_GET["status"]==3){
            $tasks->where("status_id",3);
        }
        
        if(isset($_GET["status"]) && $_GET["status"]==4){
            $tasks->onlyTrashed();
        }

        if(isset($_GET["tags"]) AND $_GET["tags"] !=''){
            $tasktags=DB::table('task_task_tag')->where('task_tag_id',$_GET["tags"])->get();
            $tasks_ids = [];
             foreach($tasktags as $t){
                $tasks_ids[] =  $t->task_id;
             }
             $tasks->whereIn("id",$tasks_ids);
        }
        
        $tasks = $tasks->get();

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::pluck('name', 'id');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tasks.index', compact('tasks','statuses','tags','assigned_tos'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::pluck('name', 'id');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tasks.create', compact('statuses', 'tags', 'assigned_tos'));
    }

    public function store(Request $request)
    {
            if(auth()->user()->id!=1 OR auth()->user()->team_id!=''){
                $team_id=auth()->user()->team_id;
            }else{
                $team_id=null;
            }
            $task = new Task;
            $task->name = $request->name;
            $task->description = $request->description;
            $task->due_date = $request->due_date;
            $task->status_id = $request->status_id;
            $task->assigned_to_id = $request->assigned_to_id;
            $task->team_id = $team_id;
            $task->save();
        $task->tags()->sync($request->input('tags', []));
        if ($request->input('attachment', false)) {
            $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $task->id]);
        }

        return redirect()->route('admin.tasks.index');
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tags = TaskTag::pluck('name', 'id');

        $assigned_tos = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $task->load('status', 'tags', 'assigned_to');

        return view('admin.tasks.edit', compact('statuses', 'tags', 'assigned_tos', 'task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());
        $task->tags()->sync($request->input('tags', []));
        if ($request->input('attachment', false)) {
            if (!$task->attachment || $request->input('attachment') !== $task->attachment->file_name) {
                if ($task->attachment) {
                    $task->attachment->delete();
                }
                $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($task->attachment) {
            $task->attachment->delete();
        }

        return redirect()->route('admin.tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->load('status', 'tags', 'assigned_to');

        return view('admin.tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
        Task::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('task_create') && Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Task();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');
        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
    
    public function edit_record($id){
        $task = Task::withTrashed()->find($id);
        $task->load(['status', 'tags', 'assigned_to']);
        return response()->json(['data'=>$task]);
    }
    public function update_record(UpdateTaskRequest $request, Task $task)
    {
        if(auth()->user()->id!=1 OR auth()->user()->team_id!=''){
          $team_id=auth()->user()->team_id;
        }else{
          $team_id=null;
        }
        $task = new Task();
        $task->exists = true;
        $task->id = $request->id;
        $task->team_id = $team_id; //already exists in database.
        $task->tags()->sync($request->input('tags', []));     
        if ($request->input('attachment', false)) {
            if (!$task->attachment || $request->input('attachment') !== $task->attachment->file_name) {
                if ($task->attachment) {
                    $task->attachment->delete();
                }
                $task->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($task->attachment) {
            $task->attachment->delete();
        }        
        $task->update($request->all());
        $task->save();
        return response()->json(['result' => '1'], Response::HTTP_CREATED);
    }
    public function delete_record(Request $request){
        Task::whereIn('id', request('delete_id'))->delete();
                return back();
        
    }
}