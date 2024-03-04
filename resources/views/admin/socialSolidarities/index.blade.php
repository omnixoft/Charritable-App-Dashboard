@extends('layouts.admin')
@section('content')
@can('social_solidarity_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.social-solidarities.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.socialSolidarity.title_singular') }}
            </a>
            <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'SocialSolidarity', 'route' => 'admin.social-solidarities.parseCsvImport']) -->
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.socialSolidarity.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-SocialSolidarity">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.socialSolidarity.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.socialSolidarity.fields.active') }}
                    </th>
                    <th>
                        {{ trans('cruds.socialSolidarity.fields.title') }}
                    </th>
                    <!-- <th>
                        {{ trans('cruds.socialSolidarity.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.socialSolidarity.fields.description_ar') }}
                    </th> -->
                    <!-- <th>
                        {{ trans('cruds.socialSolidarity.fields.images_and_videos') }}
                    </th> -->
                    <th>
                        {{ trans('cruds.socialSolidarity.fields.date') }}
                    </th>
                    <th>
                        {{ trans('cruds.socialSolidarity.fields.donation_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.socialSolidarity.fields.target_amount') }}
                    </th>
                    <th>
                        {{ trans('Collected') }}
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
    var modal_name='social_solidarities';
    var field_name='active';
    var datable_class=".datatable-SocialSolidarity";
</script>
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('social_solidarity_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
    @endcan
    btns = btn([1,3,4,5,6,7]);
    @can('social_solidarity_delete')
    btns.push(
    {
    text: deleteButtonTrans,
    url: "{{ route('admin.social-solidarities.massDestroy') }}",
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
    ajax: "{{ route('admin.social-solidarities.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
      { data: 'id', name: 'id' },
      { data: 'active', name: 'active' , sortable: false, searchable: false},
      { data: 'social_details', name: 'social_details' },
    // { data: 'description', name: 'description' },
    // { data: 'description_ar', name: 'description_ar' },
    // { data: 'images_and_videos', name: 'images_and_videos', sortable: false, searchable: false },
      { data: 'date', name: 'date' },
      { data: 'donation_type_type', name: 'donation_type.type' },
      { data: 'target_amount', name: 'target_amount' },
      { data: 'amount', name: 'amount' },
      { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-SocialSolidarity').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
});
</script>


@endsection
