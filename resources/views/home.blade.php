@extends('layouts.admin')
@section('content')
<div class="modal-size-xl d-inline-block">
   <!-- Modal -->
   <div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
         <div class="modal-content">
            <div class="modal-body">
               <div id="printableArea">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" onclick="printDiv('printableArea')" class="btn btn-info" target="_blank">Print</button>
               <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row match-height">
   <!-- Statistics Card -->
   <!-- Medal Card -->
   <div class="col-xl-4 col-md-6 col-12">
      <div class="card card-congratulation-medal">
         <div class="card-body">
            <h5>Congratulations  {{Auth::user()->name;}}!</h5>
            <p class="card-text font-small-3">You have Acheived Donation Of Approx</p>
            <h3 class="mb-75 mt-2 pt-50">
               <a href="javascript:void(0);">{{getOmr(number_format($settings1['total_donation'])) }}</a>
            </h3>
            <a href="{{route('admin.donations.index')}}"><button type="button" class="btn btn-primary">View Donation</button></a>
            <img src="{{ asset('app-assets/images/illustration/badge.svg') }}" class="congratulation-medal" alt="Medal Pic" />
         </div>
      </div>
   </div>
   <!--/ Medal Card -->
   <div class="col-xl-8 col-md-6 col-12">
      <div class="card card-statistics">
         <div class="card-header">
            <h4 class="card-title">Statistics</h4>
            <div class="d-flex align-items-center">
               <!-- <p class="card-text font-small-2 mr-25 mb-0">Updated Now</p> -->
            </div>
         </div>
         <div class="card-body statistics-body">
            <div class="row">
               <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                  <div class="media">
                     <div class="avatar bg-light-primary mr-2">
                        <div class="avatar-content">
                           <a href="{{ route("admin.teams.index") }}"><i data-feather="trending-up" class="avatar-icon"></i></a>
                        </div>
                     </div>
                     <div class="media-body my-auto">
                        <a href="{{ route("admin.teams.index") }}"><h4 class="font-weight-bolder mb-0">{{ number_format($settings1['count_number_charity']) }}</h4></a>
                        <a href="{{ route("admin.teams.index") }}"><p class="card-text font-small-3 mb-0">{{ $settings1['chart_title'] }}</p></a>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                  <div class="media">
                     <div class="avatar bg-light-info mr-2">
                        <div class="avatar-content">
                           <a href="{{ route("admin.customers.index") }}"><i data-feather="user" class="avatar-icon"></i></a>
                        </div>
                     </div>
                     <div class="media-body my-auto">
                        <a href="{{ route("admin.customers.index") }}"><h4 class="font-weight-bolder mb-0">{{ number_format($settings2['count_client']) }}</h4></a>
                        <a href="{{ route("admin.customers.index") }}"><p class="card-text font-small-3 mb-0">{{ $settings2['chart_title'] }}</p></a>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                  <div class="media">
                     <div class="avatar bg-light-danger mr-2">
                        <div class="avatar-content">
                           <a href="{{ route("admin.donations.index") }}"><i data-feather="box" class="avatar-icon"></i></a>
                        </div>
                     </div>
                     <div class="media-body my-auto">
                        <a href="{{ route("admin.donations.index") }}"><h4 class="font-weight-bolder mb-0">{{ number_format($settings3['count_donation']) }}</h4></a>
                        <a href="{{ route("admin.donations.index") }}"><p class="card-text font-small-3 mb-0">{{ $settings3['chart_title'] }}</p></a>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-sm-6 col-12">
                  <div class="media">
                     <div class="avatar bg-light-success mr-2">
                        <div class="avatar-content">
                           <a href="{{ route("admin.social-solidarities.index") }}"><i data-feather="dollar-sign" class="avatar-icon"></i></a>
                        </div>
                     </div>
                     <div class="media-body my-auto">
                        <a href="{{ route("admin.social-solidarities.index") }}"><h4 class="font-weight-bolder mb-0">{{ number_format($settings4['count_social_solidarity']) }}</h4></a>
                        <a href="{{ route("admin.social-solidarities.index") }}"><p class="card-text font-small-3 mb-0">{{ $settings4['chart_title'] }}</p></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--/ Statistics Card -->
</div>
<!-- List DataTable -->
<div class="row">
   <div class="col-12">
      <div class="card invoice-list-wrapper">
         <div class="card-datatable table-responsive">
            <table class="latestDonation invoice-list-table table">
               <thead>
                  <tr>
                     <th width="10">
                     </th>
                     <th>id</th>
                     <th>{{ trans('cruds.donation.fields.user') }}</th>
                     <th>{{ trans('cruds.donation.fields.company') }}</th>
                     <th>{{ trans('cruds.donation.fields.social_solidarity') }}</th>
                     <th class="text-truncate">{{ trans('cruds.donation.fields.date') }}</th>
                     <th>{{ trans('cruds.donation.fields.donation_type') }}</th>
                     <th>{{ trans('cruds.donation.fields.number') }}</th>
                     <th>{{ trans('cruds.donation.fields.amount') }}</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   </div>
</div>
<!--/ List DataTable -->
<div class="row match-height">
   <!-- user Card -->
   <div class="col-lg-4 col-md-6 col-12">
      <div class="card card-employee-task">
         <div class="card-header">
            <h4 class="card-title">New User List</h4>
            <!--<i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>-->
         </div>
         <div class="card-body">
            @if($user_list->isNotEmpty())
            @foreach($user_list as $c_list)
            <div class="employee-task d-flex justify-content-between align-items-center">
               <div class="media">
                  <div class="mr-75">
                     <a href="{{ $c_list->profile ? $c_list->profile->getUrl() : '' }}" target="_blank" style="display: inline-block">
                     <img class="avatar mb-75" src="{{ $c_list->profile ? $c_list->profile->getUrl('thumb') : asset('public/logo.png') }}" width="42" height="42" alt="img" />
                     </a>
                  </div>
                  <?php
                     $customerRoute = 'customers';
                     ?>
                  <div class="media-body my-auto">
                     <a href="{{ route('admin.' . $customerRoute . '.show', $c_list->id) }}">
                        <h6 class="mb-0">{{$c_list->name??''}}</h6>
                     </a>
                     <small>
                       <?= $c_list->phone!='' ? getNum1($c_list->phone) : ''  ?>
                     </small>
                  </div>
               </div>
               <div class="d-flex align-items-center">
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
                        <a class="dropdown-item" href="{{ route('admin.' . $customerRoute . '.show', $c_list->id) }}">View</a>
                     </div>
                  </div>
                  <div class="employee-task-chart-primary-1"></div>
               </div>
            </div>
            @endforeach
            @endif
         </div>
      </div>
   </div>
   <!--/ user Card -->
   <!-- Top Donation -->
   <div class="col-lg-4 col-md-6 col-12">
      <div class="card card-employee-task">
         <div class="card-header">
            <h4 class="card-title">Top Donation</h4>
            <!--<i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>-->
         </div>
         <div class="card-body">
            @if($donation_list->isNotEmpty())
            @foreach($donation_list as $d_list)
            <div class="employee-task d-flex justify-content-between align-items-center">
               <div class="media">
                  <div class="mr-75">
                     <a href="{{ isset($d_list->company)?$d_list->company->logo ? $d_list->company->logo->getUrl() : asset('public/logo.png'):asset('public/logo.png') }}" target="_blank" style="display: inline-block">
                     <img class="avatar mb-75" src="{{ isset($d_list->company)?$d_list->company->logo ? $d_list->company->logo->getUrl('thumb') : asset('public/logo.png') :asset('public/logo.png') }}" width="42" height="42" alt="img" />
                     </a>
                  </div>
                  <?php
                     $donationsRoute = 'donations';
                  ?>
                  <div class="media-body my-auto">
                     <a href="{{ route('admin.' . $donationsRoute . '.show', $d_list->id??0) }}">
                        <h6 class="mb-0">{{$d_list->company->name??''}}</h6>
                     </a>
                     <small>   
                        <?= $d_list->amount!='' ? getOmr1($d_list->amount) : '' ?>
                     </small>
                  </div>
               </div>
               <div class="d-flex align-items-center">
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
                        <a class="dropdown-item" href="{{ route('admin.' . $donationsRoute . '.show', $d_list->id) }}">View</a>
                     </div>
                  </div>
                  <div class="employee-task-chart-primary-1"></div>
               </div>
            </div>
            @endforeach
            @endif
         </div>
      </div>
   </div>
   <!-- Top Donation -->
   <!-- todo_list -->
   <div class="col-lg-4 col-md-6 col-12">
      <div class="card card-employee-task">
         <div class="card-header">
            <h4 class="card-title">Todo</h4>
            <!--<i data-feather="more-vertical" class="font-medium-3 cursor-pointer"></i>-->
         </div>
         <div class="card-body">
            @if($todo_list->isNotEmpty())
            @foreach($todo_list as $d_list)
            <div class="employee-task d-flex justify-content-between align-items-center">
               <div class="media">
                  <div class="mr-75">
                     <a href="{{ $d_list->attachment ? $d_list->attachment->getUrl() : '' }}" target="_blank" style="display: inline-block">
                     <img class="avatar mb-75" src="{{ $d_list->attachment ? $d_list->attachment->getUrl('thumb') : asset('public/logo.png') }}" width="42" height="42" alt="img" />
                     </a>
                  </div>
                  <?php
                     $tasksRoute = 'tasks';
                     ?>
                  <div class="media-body my-auto">
                     <a href="{{ route('admin.' . $tasksRoute . '.show', $d_list->id) }}">
                        <h6 class="mb-0">{{$d_list->name??''}}</h6>
                     </a>
                     <small class="text-info">{{$d_list->due_date??''}}</small>
                  </div>
               </div>
               <div class="d-flex align-items-center">
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
                        <a class="dropdown-item" href="{{ route('admin.' . $tasksRoute . '.show', $d_list->id) }}">View</a>
                     </div>
                  </div>
                  <div class="employee-task-chart-primary-1"></div>
               </div>
            </div>
            @endforeach
            @endif
         </div>
      </div>
   </div>
   <!-- todo_list -->
</div>
<br>
@endsection
@section('scripts')
@parent
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> --}}
<script>
$(function () {
  'use strict';

  var dtInvoiceTable = $('.latestDonation');
 
  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // datatable
  if (dtInvoiceTable.length) {
    var dtInvoice = dtInvoiceTable.DataTable({
      ajax: "{{ Route('admin.latestDonation')}}", // JSON file to add data
      autoWidth: false,
      columns: [
        // columns according to JSON
        { data: "nu"},
        { data: 'id' },
        { data: 'customerDetails'},
        { data: 'charity' },
        { data: 'social' },
        { data: 'date' },
        { data: 'donation_type' },
        { data: 'number' },
        { data: 'amount' }
      ],
      order: [[1, 'desc']],
      lengthMenu: [10],
      dom:
        '<"row d-flex justify-content-between align-items-center m-1"' +
        '<"col-lg-6 d-flex align-items-center"l<"dt-action-buttons text-xl-right text-lg-left text-lg-right text-left "B>>' +
        '<"col-lg-6 d-flex align-items-center justify-content-lg-end flex-lg-nowrap flex-wrap pr-lg-1 p-0"f<"invoice_status ml-sm-2">>' +
        '>t' +
        '<"d-flex justify-content-between mx-2 row"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: 'Show _MENU_',
        search: 'Search',
        searchPlaceholder: 'Search',
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      // Buttons with Dropdown
      buttons: [
        {
          text: '<i data-feather="refresh-cw"></i>',
          className: 'btn btn-primary btn-add-record ml-2',
          action: function (e, dt, button, config) {
            dt.clear().draw();
                dt.ajax.reload();
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['client_name'];
            }
          }),
          type: 'column',
          renderer: $.fn.dataTable.Responsive.renderer.tableAll({
            tableClass: 'table',
            columnDefs: [
              {
                targets: 2,
                visible: false
              },
              {
                targets: 3,
                visible: false
              }
            ]
          })
        }
      },
      initComplete: function () {
        $(document).find('[data-toggle="tooltip"]').tooltip();
        // Adding role filter once table initialized
        this.api()
          .columns(6)
          .every(function () {
            var column = this;
            var select = $(
              '<select id="UserRole" class="form-control ml-50 text-capitalize"><option value=""> Select Type </option></select>'
            )
              .appendTo('.invoice_status')
              .on('change', function () {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });

            column
              .data()
              .unique()
              .sort()
              .each(function (d, j) {
                 if(d){
                   select.append('<option value="' + d + '" class="text-capitalize">' + d.substr(0,10) +'...' + '</option>');
                 }

              });
          });
      },
      drawCallback: function () {
        $(document).find('[data-toggle="tooltip"]').tooltip();
      }
    });
  }
});
</script>
@endsection
