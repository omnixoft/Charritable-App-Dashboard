@extends('layouts.admin')
@section('content')
@can('feedback_create')
    <!-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.feedback.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.feedback.title_singular') }}
            </a>
        </div>
    </div> -->
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.feedback.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Feedback">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.feedback.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.feedback.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.feedback.fields.number') }}
                    </th>
                    <th>
                        {{ trans('cruds.feedback.fields.message') }}
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('feedback_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
    @endcan
    btns = btn([1,2,3,4]);
    @can('feedback_delete')
    btns.push(
    {
    text: deleteButtonTrans,
    url: "{{ route('admin.feedback.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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
   );
   @endcan
    let dtOverrideGlobals = {
      columnDefs: [ {
                            orderable: false,
                            "defaultContent": "",
                            className: 'select-checkbox',
                            targets:   0
                        }],
    buttons: btns,
    processing: true,
    // serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.feedback.index') }}",
    columns: [
    { data: 'placeholder', name: 'placeholder' },
    { data: 'id', name: 'id' },
    { data: 'name', name: 'name' },
    { data: 'number', name: 'number' },
    { data: 'message', name: 'message' },
    { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Feedback').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
});
</script>

@endsection
