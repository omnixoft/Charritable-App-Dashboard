@extends('layouts.admin')
@section('content')
@can('ayaht_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.ayahts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.ayaht.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.ayaht.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Ayaht">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.ayaht.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.ayaht.fields.title') }}
                    </th>
                    <th>
                        {{ trans('cruds.ayaht.fields.title_ar') }}
                    </th>
                    <th>
                        {{ trans('cruds.ayaht.fields.ayaht') }}
                    </th>
                    <th>
                        {{ trans('cruds.ayaht.fields.translation') }}
                    </th>
                    <th>
                        {{ trans('cruds.ayaht.fields.refrence') }}
                    </th>
                    <th>
                        {{ trans('cruds.ayaht.fields.refrence_ar') }}
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
    @can('ayaht_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
    @endcan
    btns = btn([1,2,3,4,5,6,7]);
    @can('ayaht_delete')
    btns.push(
    {
    text: deleteButtonTrans,
    url: "{{ route('admin.ayahts.massDestroy') }}",
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
    ajax: "{{ route('admin.ayahts.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'title_ar', name: 'title_ar' },
        { data: 'ayaht', name: 'ayaht' },
        { data: 'translation', name: 'translation' },
        { data: 'refrence', name: 'refrence' },
        { data: 'refrence_ar', name: 'refrence_ar' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Ayaht').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
});
</script>
@endsection