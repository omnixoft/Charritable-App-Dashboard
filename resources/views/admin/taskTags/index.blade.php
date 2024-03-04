@extends('layouts.admin')
@section('content')
@can('task_tag_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.task-tags.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.taskTag.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taskTag.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TaskTag">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taskTag.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.taskTag.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taskTags as $key => $taskTag)
                        <tr data-entry-id="{{ $taskTag->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taskTag->id ?? '' }}
                            </td>
                            <td>
                                {{ $taskTag->name ?? '' }}
                            </td>
                            <td>
                                <div class="dropdown">
                                <a class="btn btn-sm btn-icon" data-toggle="dropdown"><i class='fa fa-ellipsis-v'></i></a> 
                                <div class="dropdown-menu dropdown-menu-right">
                                @can('task_tag_show')
                                    <a class="dropdown-item" href="{{ route('admin.task-tags.show', $taskTag->id) }}">
                                        <i class="fa fa-eye"></i> 
                                        <span class="ml-1">
                                        {{ trans('global.view') }}
                                        </span>
                                    </a>
                                @endcan
                                @can('task_tag_edit')
                                    <a class="dropdown-item" href="{{ route('admin.task-tags.edit', $taskTag->id) }}">
                                        <i class="fa fa-pen"></i>  
                                        <span class="ml-1">
                                        {{ trans('global.edit') }}
                                        </span>
                                    </a>
                                @endcan
                                @can('task_tag_delete')
                                    <form action="{{ route('admin.task-tags.destroy', $taskTag->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="dropdown-item btn-block w-100" > 
                                        <i class="fa fa-trash"></i> 
                                        <span class="ml-1">{{ trans('global.delete') }}</span>
                                        </button>
                                    </form>
                                @endcan
                                </div> 
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
@can('task_tag_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  btns = btn([1,2]);
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.task-tags.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')
        return
      }
      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-TaskTag:not(.ajaxTable)').DataTable(
      {        
      columnDefs: [ {
                            orderable: false,
                            "defaultContent": "",
                            className: 'select-checkbox',
                            targets:   0
                        }],
          buttons: [
    btns,
    deleteButton
] })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });  
})
</script>
@endsection
