@extends('layouts.admin')
@section('content')
@can('banner_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.banners.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.banner.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.banner.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Banner">
            <thead>
                <tr>
                    <th width="10">
                    </th>
                    <th>
                        {{ trans('cruds.banner.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.banner.fields.status') }}
                    </th>
                    <th>
                        {{ trans('cruds.banner.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.banner.fields.image') }}
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
    var modal_name='banners';
    var field_name='status';
    var datable_class=".datatable-Banner";
</script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('banner_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
    @endcan
    btns = btn([1,3]);
    @can('banner_delete')
    btns.push(
    {
    text: deleteButtonTrans,
    url: "{{ route('admin.banners.massDestroy') }}",
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
    ajax: "{{ route('admin.banners.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'status', name: 'status',sortable: false, searchable: false },
      { data: 'title', name: 'title' },
      { data: 'image', name: 'image', sortable: false, searchable: false },
      { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Banner').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
});
</script>
@endsection
