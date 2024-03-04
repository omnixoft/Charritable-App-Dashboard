@extends('layouts.admin')
@section('content')
<div class="app-content todo-application">
   <div class="content-overlay"></div>
   <div class="header-navbar-shadow"></div>
   <div class="content-area-wrapper container-xxl p-0">
      <div class="sidebar-left">
         <div class="sidebar">
            <div class="sidebar-content todo-sidebar">
               <div class="todo-app-menu">
                  <div class="add-task">
                     @can('task_create')
                     <button onclick="null_add_modal()" type="button" class="btn btn-primary btn-block" data-toggle="modal"  data-target="#new-task-modal">
                     Add Task
                     </button>
                     @endcan
                  </div>
                  <div class="sidebar-menu-list">
                     <div class="list-group list-group-filters">
                        <a href="?status=1" class="list-group-item list-group-item-action <?php echo (isset($_GET['status']) && $_GET['status']==1 ? "active" : "")?>">
                        <i data-feather="star" class="font-medium-3 mr-50"></i> <span class="align-middle">All</span>
                        </a>
                        <a href="?status=2" class="list-group-item list-group-item-action <?php echo (isset($_GET['status']) && $_GET['status']==2 ? "active" : "")?>">
                        <i data-feather="mail" class="font-medium-3 mr-50"></i>
                        <span class="align-middle"> My Task</span>
                        </a>
                        <a href="?status=3" class="list-group-item list-group-item-action <?php echo (isset($_GET['status']) && $_GET['status']==3 ? "active" : "")?>">
                        <i data-feather="check" class="font-medium-3 mr-50"></i> <span class="align-middle">Completed</span>
                        </a>
                        <a href="?status=4" class="list-group-item list-group-item-action <?php echo (isset($_GET['status']) && $_GET['status']==4 ? "active" : "")?>">
                        <i data-feather="trash" class="font-medium-3 mr-50"></i> <span class="align-middle">Deleted</span>
                        </a>
                     </div>
                     <div class="mt-3 px-2 d-flex justify-content-between">
                        <h6 class="section-label mb-1">Tags</h6>
                        <a href="{{ route('admin.task-tags.create') }}"><i data-feather="plus" class="cursor-pointer"></i></a>
                     </div>
                     <div class="list-group list-group-labels">
                        @foreach($tags as $key => $item)
                        <a href="?tags=<?php echo $key;?>" class="list-group-item list-group-item-action d-flex align-items-center">
                        <span class="bullet bullet-sm bullet-primary mr-1"></span>{{ $item }}
                        </a>
                        @endforeach
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="content-right">
         <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
               <div class="body-content-overlay"></div>
               <div class="todo-app-list">
                  <!-- Todo search starts -->
                  <div class="app-fixed-search d-flex align-items-center">
                     <div class="sidebar-toggle d-block d-lg-none ml-1">
                        <i data-feather="menu" class="font-medium-5"></i>
                     </div>
                     <div class="d-flex align-content-center justify-content-between w-100">
                        <div class="input-group input-group-merge">
                           <div class="input-group-prepend">
                              <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
                           </div>
                           <input
                              type="text"
                              class="form-control"
                              id="todo-search"
                              placeholder="Search task"
                              aria-label="Search..."
                              aria-describedby="todo-search"
                              />
                        </div>
                     </div>
                     <div class="dropdown">
                        <a
                           href="javascript:void(0);"
                           class="dropdown-toggle hide-arrow mr-1"
                           id="todoActions"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false"
                           >
                        <i data-feather="more-vertical" class="font-medium-2 text-body"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="todoActions">
                           <a class="dropdown-item sort-asc" href="javascript:void(0)">Sort A - Z</a>
                           <a class="dropdown-item sort-desc" href="javascript:void(0)">Sort Z - A</a>
                           <a class="dropdown-item" href="javascript:void(0)">Sort Assignee</a>
                           <a class="dropdown-item" href="javascript:void(0)">Sort Due Date</a>
                           <a class="dropdown-item" href="javascript:void(0)">Sort Today</a>
                           <a class="dropdown-item" href="javascript:void(0)">Sort 1 Week</a>
                           <a class="dropdown-item" href="javascript:void(0)">Sort 1 Month</a>
                        </div>
                     </div>
                  </div>
                  <!-- Todo search ends -->
                  <!-- Todo List starts -->
                  <div class="todo-task-list-wrapper list-group">
                     <ul class="todo-task-list media-list" id="todo-task-list">
                        <?php $num_check=0;?>
                        @foreach($tasks as $tasks_list)
                        <?php $num_check++;?>
                        <li class="todo-item" data-id="{{ $tasks_list->id }}">
                           <div class="todo-title-wrapper">
                              <div class="todo-title-area">
                                 <i data-feather="more-vertical" class="drag-icon"></i>
                                 <div class="title-wrapper">
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" class="custom-control-input" id="customCheck<?php echo $num_check;?>" />
                                       <label class="custom-control-label" for="customCheck<?php echo $num_check;?>"></label>
                                    </div>
                                    <span class="todo-title">{{$tasks_list->name}}</span>
                                 </div>
                              </div>
                              <div class="todo-item-action">
                                 <div class="badge-wrapper mr-1">
                                    @foreach($tasks_list->tags as $key => $item)
                                    <div class="badge badge-pill badge-light-primary">{{ $item->name }}</div>
                                    @endforeach
                                 </div>
                                 <small class="text-nowrap text-muted mr-1">{{ $tasks_list->due_date ?? '' }}</small>
                                 <!--<div class="avatar">-->
                                 <!--   <img-->
                                 <!--      src="../../../app-assets/images/portrait/small/avatar-s-4.jpg"-->
                                 <!--      alt="user-avatar"-->
                                 <!--      height="32"-->
                                 <!--      width="32"-->
                                 <!--      />-->
                                 <!--</div>-->
                                 @if($tasks_list->attachment)
                                 <a href="{{ $tasks_list->attachment->getUrl() }}" target="_blank">
                                 {{ trans('global.view_file') }}
                                 </a>
                                 @endif
                              </div>
                           </div>
                        </li>
                        @endforeach
                     </ul>
                     <div class="no-results">
                        <h5>No Items Found</h5>
                     </div>
                  </div>
                  <!-- Todo List ends -->
               </div>
               <!-- Right Sidebar starts -->
               <div class="modal modal-slide-in sidebar-todo-modal fade" id="new-task-modal">
                  <div class="modal-dialog sidebar-lg">
                     <div class="modal-content p-0">
                        <!--<form id="form-modal-todo" class="todo-modal needs-validation" novalidate onsubmit="return false">-->
                        <div class="modal-header align-items-center mb-1">
                           <h5 class="modal-title">Add Task</h5>
                           <div class="todo-item-action d-flex align-items-center justify-content-between ml-auto">
                              <span class="todo-item-favorite cursor-pointer mr-75"
                                 ><i data-feather="star" class="font-medium-2"></i
                                 ></span>
                              <button
                                 type="button"
                                 class="close font-large-1 font-weight-normal py-0"
                                 data-dismiss="modal"
                                 aria-label="Close"
                                 >
                              ×
                              </button>
                           </div>
                        </div>
                        <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                           <div class="action-tags">
                              <form id="updateForm" method="POST" action="{{ route("admin.tasks.store") }}" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="id" id="id">
                              <div class="form-group">
                                 <label class="" for="name">Title</label>
                                 <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                                 @if($errors->has('name'))
                                 <span class="text-danger">{{ $errors->first('name') }}</span>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.task.fields.name_helper') }}</span>
                              </div>
                              <div class="form-group">
                                 <label for="assigned_to_id">{{ trans('cruds.task.fields.assigned_to') }}</label>
                                 <select class="form-control  {{ $errors->has('assigned_to') ? 'is-invalid' : '' }}" name="assigned_to_id" id="assigned_to_id">
                                 @foreach($assigned_tos as $id => $entry)
                                 <option value="{{ $id }}" {{ old('assigned_to_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                 @endforeach
                                 </select>
                                 @if($errors->has('assigned_to'))
                                 <span class="text-danger">{{ $errors->first('assigned_to') }}</span>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.task.fields.assigned_to_helper') }}</span>
                              </div>
                              <div class="form-group">
                                 <label for="due_date">{{ trans('cruds.task.fields.due_date') }}</label>
                                 <input class="form-control date {{ $errors->has('due_date') ? 'is-invalid' : '' }}" type="date" name="due_date" id="due_date" value="{{ old('due_date') }}">
                                 @if($errors->has('due_date'))
                                 <span class="text-danger">{{ $errors->first('due_date') }}</span>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.task.fields.due_date_helper') }}</span>
                              </div>
                              <div class="form-group">
                                 <label for="tags">{{ trans('cruds.task.fields.tag') }}</label>
                                 <div style="padding-bottom: 4px">
                                    <!--<span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>-->
                                    <!--<span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>-->
                                 </div>
                                 <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                                 @foreach($tags as $id => $tag)
                                 <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                                 @endforeach
                                 </select>
                                 @if($errors->has('tags'))
                                 <span class="text-danger">{{ $errors->first('tags') }}</span>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.task.fields.tag_helper') }}</span>
                              </div>
                              <div class="form-group">
                                 <label class="" for="status_id">{{ trans('cruds.task.fields.status') }}</label>
                                 <select class="form-control  {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                                 @foreach($statuses as $id => $entry)
                                 <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                 @endforeach
                                 </select>
                                 @if($errors->has('status'))
                                 <span class="text-danger">{{ $errors->first('status') }}</span>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.task.fields.status_helper') }}</span>
                              </div>
                              <div class="form-group">
                                 <label for="attachment">{{ trans('cruds.task.fields.attachment') }}</label>
                                 <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                                 </div>
                                 @if($errors->has('attachment'))
                                 <span class="text-danger">{{ $errors->first('attachment') }}</span>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.task.fields.attachment_helper') }}</span>
                              </div>
                              <div class="form-group">
                                 <label for="description">{{ trans('cruds.task.fields.description') }}</label>
                                 <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                                 @if($errors->has('description'))
                                 <span class="text-danger">{{ $errors->first('description') }}</span>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.task.fields.description_helper') }}</span>
                              </div>
                           </div>
                           <div class="form-group my-1">
                              <button type="submit" class="btn btn-primary d-none add-todo-item mr-1">Add</button>
                              <button type="button" class="btn btn-outline-secondary add-todo-item d-none" data-dismiss="modal">
                              Cancel
                              </button>
                              <button type="submit" id="btn_update" class="btn btn-primary d-none update-btn update-todo-item mr-1">Update</button>
                                @can('task_delete')
                                    <!--<form action="{{ route('admin.tasks.delete_record') }}" method="POST" style="display: inline-block;">-->
                                    <!--    <input type="hidden" name="_method" value="DELETE">-->
                                    <!--    <input type="hidden" name="delete_id" id="delete_id" value="">-->
                                    <!--    <input type="hidden" name="_token" value="{{ csrf_token() }}">-->
                                        <a class="btn btn-outline-danger del" id="delete_id">{{ trans('global.delete') }}</a>
                                    <!--</form>-->
                                @endcan
                           </div>
                        </div>
                        </form>
                        <!--</form>-->
                     </div>
                  </div>
               </div>
               <!-- Right Sidebar ends -->
            </div>
         </div>
      </div>
   </div>
</div>
<!-- END: Content-->
@endsection
@section('scripts')
<script>
   function null_add_modal()
   {
   $("#id").val('');
   $("#name").val('');
   $("#description").val('');
   $("#due_date").val('');
   $("#assigned_to_id").val('');
   $("#status_id").val('');
   $("#delete_id").val('');
   // $("#tags").html('');
    // if (($(".dz-preview").length) || ($(".dz-image-preview").length)){
    // // Do something if class exists
    //     alert("Image exit");
    //     // $('.dz-preview .dz-processing .dz-image-preview .dz-complete').remove();
    //     // $('.dz-image-preview').remove();
    //     // $("div").removeClass("dz-started");

    //         // if (($(".dz-remove").length)){)

    //         // var all = $(".dz-remove").map(function() {
    //         //     return this.innerHTML;
    //         // }).get();

    //         // console.log(all.join());




    //             $(".dz-remove").trigger('click');
    //         $(".dz-remove").click(function(){
    //           alert("sss");
    //         });


    // }
   }



   var   task = '';
   var optionss;
    Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.tasks.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="attachment"]').remove()
      $('form').append('<input type="hidden" name="attachment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="attachment"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
        if(task==''){
             optionss = this.options;
            console.log("empty ",optionss)
        }
if(task.attachment){
      var file = task.attachment;
      this.options = optionss;
    console.log("This ",file)
    //  this.options.addedfile.call(this, file)
    //   this.options.thumbnail.call(this, file, file.preview)

// console.log("file ",this)
    //   file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="attachment" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
}
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
      });
   $(document).on("click",".todo-item",function(){


      $("#tags option").each(function(){ $(this).removeAttr("selected").trigger('change');; })


        var id=$(this).data("id");
        let _url = `tasks/edit_record/${id}`;

          $.ajax({
             url: _url,
             type: "GET",
             dataType:'json',
             success: function(response) {
                //   $(".modal-body").html(response);
                task = response.data;
                // console.log(task);
       Dropzone.options.attachmentDropzone.init();
                 if(response) {
                   console.log(response.data);
                  $("#id").val(response.data.id);
                  $("#name").val(response.data.name);
                  $("#description").val(response.data.description);
                  $("#due_date").val(response.data.due_date);
                  $("#assigned_to_id").val(response.data.assigned_to.id);
                  $("#status_id").val(response.data.status_id);
                  $("#delete_id").attr("data-id",response.data.id);


                  var tags_list=response.data.tags;

                  $.each(tags_list, function(key,val) {

                      // console.log($("#tags").html());
                      $("#tags option").each(function(){

                          if(val.id==$(this).val()){
                              //  console.log($(this).val());
                              $(this).remove();
                          }

                      })
                        var $newOption = $("<option selected='selected'></option>").val(val.id).text(val.name)
                      $("#tags").append($newOption).trigger('change');


                  });

                 }
             }
          });
   });
   $(document).on("click",".del",function(){
       var id=$(this).data("id");
    //   $.ajax({
    //          url: "{{ route('admin.tasks.delete_record') }}",
    //          type: "post",
    //          data:{id:id},
    //          dataType:'json',
    //          success: function(response) {

    //          }
    //   });
    ids = [id];
      if (confirm('{{ trans('global.areYouSure') }}')) {
            $.ajax({
              headers: {'x-csrf-token': _token},
              method: 'POST',
              url:"{{ route('admin.tasks.massDestroy') }}",
              data: { ids: ids, _method: 'DELETE' }})
              .done(function () { location.reload() })
          }
   })
       $('#btn_update').on('click', function(event){
           event.preventDefault();
           var form_data = $("#updateForm").serialize();
           // console.log(form_data);
           $.ajax({
               url: '{{route('admin.tasks.update_record')}}',
               method:"POST",
               data:form_data,
               dataType:"json",
               success:function(data)
               {
                   // console.log(data);
                   if(data.result=="1")
                    {
                       alert("update Successfully");
                       location.reload();
                    }

               }
           })
       });


</script>
@parent
// <script>
   //     $(function () {
   //   let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
   // @can('task_delete')
   //   let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
   //   let deleteButton = {
   //     text: deleteButtonTrans,
   //     url: "{{ route('admin.tasks.massDestroy') }}",
   //     className: 'btn-danger',
   //     action: function (e, dt, node, config) {
   //       var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
   //           return $(entry).data('entry-id')
   //       });

   //       if (ids.length === 0) {
   //         alert('{{ trans('global.datatables.zero_selected') }}')

   //         return
   //       }

   //       if (confirm('{{ trans('global.areYouSure') }}')) {
   //         $.ajax({
   //           headers: {'x-csrf-token': _token},
   //           method: 'POST',
   //           url: config.url,
   //           data: { ids: ids, _method: 'DELETE' }})
   //           .done(function () { location.reload() })
   //       }
   //     }
   //   }
   //   dtButtons.push(deleteButton)
   // @endcan

   //   $.extend(true, $.fn.dataTable.defaults, {
   //     orderCellsTop: true,
   //     order: [[ 1, 'desc' ]],
   //     pageLength: 10,
   //   });
   //   let table = $('.datatable-Task:not(.ajaxTable)').DataTable({ buttons: dtButtons })
   //   $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
   //       $($.fn.dataTable.tables(true)).DataTable()
   //           .columns.adjust();
   //   });

   // })

   //
</script>
@endsection
