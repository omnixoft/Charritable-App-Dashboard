@extends('layouts.admin')
@section('content')
<!-- Edit Modal -->
<div class="modal fade text-left" id="editForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel33">Add Charges</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
    <form action="#" id="updateForm">
        @csrf
    <div class="modal-body">
    <label>Shipment Charges: </label>
    <div class="form-group">
        <input type="hidden" name="record_id" id="will_record_id" value="">
        <input type="number" placeholder="Shipment Charges" name="ship_charges" id="will_shipment_charges" value="" class="form-control" />
    </div>
    </div>
    <div class="modal-footer">
    <button type="submit" id="btn_update" class="btn btn-primary" data-dismiss="modal">Submit</button>

    </div>
    </form>
</div>
    </div>
</div>
@can('wilayat_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.wilayats.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.wilayat.title_singular') }}
            </a>
            <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Wilayat', 'route' => 'admin.wilayats.parseCsvImport']) -->
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.wilayat.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Wilayat">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.wilayat.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.wilayat.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.wilayat.fields.name_ar') }}
                    </th>
                    {{-- <th>
                        {{ trans('cruds.wilayat.fields.charges') }}
                    </th> --}}
                    <th>
                        {{ trans('cruds.wilayat.fields.government') }}
                    </th>
                    <th>
                        {{ trans('cruds.wilayat.fields.government_ar') }}
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
    btns = btn([1,2,3,4,5]);
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
    ajax: "{{ route('admin.wilayats.index') }}",
    columns: [
    { data: 'placeholder', name: 'placeholder' },
    { data: 'id', name: 'id' },
    { data: 'name', name: 'name' },
    { data: 'name_ar', name: 'name_ar' },
    // { data: 'charges', name: 'charges' },
    { data: 'governorate_name', name: 'governorate.name' },
    { data: 'governorate_ar', name: 'governorate.name_ar' },
    { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Wilayat').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
});
</script>
<script>
   function getcharges(will_id)
   {
       $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
          });
       var id=will_id;
       let _url = `wilayats/willayat_records/${id}`;
           
              $.ajax({
                url: _url,
                type: "GET",
                dataType:"json",
                success: function(response) {
                    if(response) 
                    {
                        // console.log(response);
                        $("#will_record_id").val(response.willayat_record[0].id);
                        $("#will_shipment_charges").val(response.willayat_record[0].charges);
                    }
                }
              });    
   }
       $('#btn_update').on('click', function(event){
           event.preventDefault();
           var form_data = $("#updateForm").serialize();
            // console.log(form_data);
           $.ajax({
               url: '{{route('admin.wilayats.update_record')}}',
               method:"POST",
               data:form_data,
               dataType:"json",
               success:function(data)
               {
                    // console.log(data);
                   if(data.result=="1")
                    {
                       $('.datatable-Wilayat').DataTable().ajax.reload();  
                       alert("Update Successfully");
                    }
               }
           });
       });   

</script>
@endsection
