@extends('layouts.admin')
@section('content')
@can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.user.title_singular') }}
            </a>
            <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'User', 'route' => 'admin.users.parseCsvImport']) -->
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-User">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.user.fields.id') }}
                    </th>
                   <th>
                        {{ trans('cruds.user.fields.approved') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.title_singular') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.c_details') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.two_factor') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.verified') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.roles') }}
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
     $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
      });
    var modal_name='users';
    var field_name='approved';
    var datable_class=".datatable-User";
</script>
<script>
    var modal_name2='users';
    var field_name2='two_factor';
    var datable_class2=".datatable-User";
$(document).on("change",".status_index2",function(e){
    var record_id2=$(this).data("id");
    if($(this).is(":checked")){
        var status2=1;
    }else{
        var status2=0;
    }
       $.ajax({
             url: '{{route('admin.customers.update_status')}}',
             method:"POST",
             data:{record_id:record_id2,status:status2,modal_name:modal_name2,field_name:field_name2},
             dataType:"json",
             success:function(data)
             {
                 if(data.result=="1")
                 {
                     $(datable_class2).DataTable().ajax.reload();
                 }
               }
           });
});
</script>
<script>
    var modal_name3='users';
    var field_name3='verified';
    var datable_class3=".datatable-User";
$(document).on("change",".status_index3",function(e){
    var record_id3=$(this).data("id");
    if($(this).is(":checked")){
        var status3=1;
    }else{
        var status3=0;
    }
       $.ajax({
             url: '{{route('admin.customers.update_status')}}',
             method:"POST",
             data:{record_id:record_id3,status:status3,modal_name:modal_name3,field_name:field_name3},
             dataType:"json",
             success:function(data)
             {
                 if(data.result=="1")
                 {
                     $(datable_class3).DataTable().ajax.reload();
                 }
               }
           });
});
</script>
<script>
    $(function () {
    let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
    @can('user_delete')
    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
    @endcan
    btns = btn([1,3,4,7]);
    @can('user_delete')
    btns.push(
    {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
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
    ajax: "{{ route('admin.users.index') }}",
    columns: [
    { data: 'placeholder', name: 'placeholder' },
    { data: 'id', name: 'id' },
    { data: 'approved', name: 'approved',sortable: false, searchable: false },
    { data: 'u_details', name: 'u_details' },
    { data: 'c_details', name: 'c_details' },
    { data: 'two_factor', name: 'two_factor' },
    { data: 'verified', name: 'verified' },
    { data: 'roles', name: 'roles.title' },
    { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-User').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
});
</script>
@endsection
