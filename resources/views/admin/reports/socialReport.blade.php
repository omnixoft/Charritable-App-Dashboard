@extends('layouts.admin')
@section('content')
<section class="tooltip-validations" id="tooltip-validation">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h4 class="card-title">{{ trans('cruds.socialSolidarity.title_singular') }} {{ trans('global.report') }}</h4>
            </div>
            <div class="card-body">
               <div class="form-row">
                  <div class="col-md-3 col-12  mb-1">
                     <label for="company_id">{{ ucfirst(trans('cruds.donation.fields.company')) }}</label>
                     <select class="form-control  {{ $errors->has('company_id') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                     @foreach($charity as $id => $entry)
                     <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                     @endforeach
                     </select>
                  </div>
                  <div class="col-md-3 col-12  mb-1">
                     <label for="social_id">{{ trans('cruds.donation.fields.donation_type') }}</label>
                     <select class="form-control  {{ $errors->has('social_id') ? 'is-invalid' : '' }}" name="social_id" id="social_id">
                     @foreach($donation as $id => $entry)
                     <option value="{{ $id }}" {{ old('social_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                     @endforeach
                     </select>
                  </div>
                  <div class="col-md-2 col-12  mb-1">
                     <label for="fp-default">Date From</label>
                     <input type="date" name="date_from" id="date_from" class="form-control"  required/>
                  </div>
                  <div class="col-md-2 col-12  mb-1">
                     <label for="fp-default">Date To</label>
                     <input type="date" name="date_to" id="date_to" class="form-control" required/>
                  </div>
                  <div class="col-md-2 col-12 mb-1 m-auto">
                     <button id="filter" class="btn btn-outline-info" style="margin-top:9px;">Filter</button>
                  </div>
               </div>
               <div class="form-row d-none" id="totaDonation">
               </div>
               <!--<button id="reset" class="btn btn-outline-warning btn-sm">Reset</button>-->
            
            @can('donation_create')
                <!-- <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-success" href="{{ route('admin.donations.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.donation.title_singular') }}
                    </a>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                        {{ trans('global.app_csvImport') }}
                    </button>
                    @include('csvImport.modal', ['model' => 'Donation', 'route' => 'admin.donations.parseCsvImport'])
                </div>
                </div> -->
                @endcan
                <!-- Search Form Start -->
               <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Donation">
                  <thead>
                     <tr>
                        <th width="10">
                        </th>
                        <th>
                           {{ trans('cruds.donation.fields.id') }}
                        </th>
                        <th>
                           {{ trans('cruds.donation.fields.user') }}
                        </th>
                        <th>
                           {{ trans('cruds.donation.fields.company') }}
                        </th>
                        <th>
                           {{ trans('cruds.donation.fields.social_solidarity') }}
                        </th>
                        <th>
                           {{ trans('cruds.donation.fields.date') }}
                        </th>
                        <th>
                           {{ trans('cruds.donation.fields.donation_type') }}
                        </th>
                        <th>
                           {{ trans('cruds.donation.fields.amount') }}
                        </th>
                        <!-- <th>
                           &nbsp;
                        </th> -->
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- Search Form end -->
<div class="card">
</div>
@endsection
@section('scripts')
@parent
<script>
   
        function fetch(company_id,social_id,date_from,date_to) {
            $.ajaxSetup({headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});
            $.ajax({
                url: "{{ route('admin.report.socialReport') }}",
                type: "GEt",
                data: {
                    company_id: company_id,
                    social_id: social_id,
                    date_from: date_from,
                    date_to: date_to
                },
                dataType: "json",
                success: function(data) 
                {                   
                  var DonationData=[];
                  if(data.donations.length > 0){
                     DonationData=data.donations;
                  }
                     
                  if(DonationData.length > 0){
                        if(data.donations[0].total){
                        // alert(data.donations[0].total);
                        $("#totaDonation").removeClass("d-none").html("<div class='col-sm-12'><span><b style='color:black;'>Total Donation :</b> <b class='text-info'>"+data.donations[0].total+" OMR</b></span></div>")
                     }
                  }else{
                     $("#totaDonation").addClass("d-none");
                  }

                    btns = btn([1, 2, 3 ,4 , 5, 6, 7]);
                    let table = $('.datatable-Donation').DataTable({
                        columnDefs: [ 
                           {
                            orderable: false,
                            "defaultContent": "",
                            className: 'select-checkbox',
                            targets:   0
                        },
                        {
                            "defaultContent": "-",
                                columns: [1, 2, 3 ,4 , 5, 6, 7],
                        }],
                        buttons: btns,
                        "data": DonationData,
                        "responsive": true,
                        "columns": [
                            {
                                "data": "&nbsp;",
                            },
                            {
                                "data": "id"
                            },
                            {
                                "data": "customerDetails"
                            },
                            {
                                "data": "charity"
                            },
                            {
                                "data": "social"
                            },
                            {
                                "data": "date"
                            },
                            {
                                "data": "donation_type"
                            },
                            {
                                "data": "amount"
                            }                                                     
                        ]
                    });
                }
            });
        }

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        fetch();
        // Filter
        $(document).on("click", "#filter", function(e) {
            e.preventDefault();
            var company_id = $("#company_id").val();
            var social_id = $("#social_id").val();
            var date_from = $("#date_from").val();
            var date_to = $("#date_to").val();
            
            $('.datatable-Donation').DataTable().destroy();
            fetch(company_id,social_id,date_from,date_to);
        });
</script>
@endsection
