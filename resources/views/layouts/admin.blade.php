<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
  
    <link rel="apple-touch-icon" href="{{asset("app-assets/images/ico/apple-icon-120.png")}} ">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("app-assets/images/ico/favicon.ico")}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
 <!-- BEGIN: Vendor CSS-->
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
 <!-- END: Vendor CSS-->
 <!-- BEGIN: Vendor CSS-->
 <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">-->
 <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">-->
 <!-- END: Vendor CSS-->
 <!-- BEGIN: Theme CSS-->
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">
 <!-- BEGIN: Page CSS-->
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
 <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">-->
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
 <!--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">-->
 <!-- END: Page CSS-->
 <!-- BEGIN: Page CSS-->
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
 <!-- END: Page CSS-->
 
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-list.css') }}">
 
 <!--todo-->
 
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-todo.min.css') }}">
 
 <!--Order item modal-->
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice.css') }}">    
 
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
 
 <!-- BEGIN: Custom CSS-->
 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-user.css') }}">
 <!-- END: Custom CSS-->
    <!--todo-->
    
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-todo.min.css') }}">

        

 <!-- template extention end-->

 <!-- qiuk admin panel extention start -->
 <!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />-->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
 <!-- <link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet" /> -->
 <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
 <!--<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />-->
 <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
 <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
 <!--<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />-->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
<style>
      div.dataTables_scrollBody thead th {
      padding: 0px !important;
}
</style>
    @yield('styles')
</head>

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

 <!-- BEGIN: Header-->
 <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
        
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
        
            @if(count(config('panel.available_languages', [])) > 1)
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown dropdown-language">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    {{ strtoupper(app()->getLocale()) }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                @foreach(config('panel.available_languages') as $langLocale => $langName)
                    <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                @endforeach
                </div>
                </li>
                </ul>
            @endif
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Explore Odex..." tabindex="-1" data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                    <i class="ficon" data-feather="bell"></i>
                        @php($alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count())
                        @if($alertsCount > 0)
                        <span class="badge badge-pill badge-danger badge-up">
                    
                            <!-- <span class="badge badge-warning navbar-badge"> -->
                                {{ $alertsCount }}
                            <!-- </span> -->
                            </span>
                        @endif
            </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            {{-- <div class="badge badge-pill badge-light-primary">6 New</div> --}}
                        </div>
                    </li>
                    <li class="scrollable-container media-list">
                        
                        @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->where('read',0)->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                        @foreach($alerts as $alert) 

                        <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar"><img src="{{ asset('/app-assets/images/portrait/small/avatar-s-15.jpg') }}" alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading">
                                        <span class="font-weight-bolder">
                                            <a href="{{ $alert->alert_link ? $alert->alert_link  : '#' }}" target="_blank" rel="noopener noreferrer">
                                                @if($alert->pivot->read === 0) <strong> @endif
                                                    {{ $alert->alert_text }}
                                            </a>
                                                    <br>
                                                    {{ $alert->alert_text_ar }}
                                                    @if($alert->pivot->read === 0) </strong> @endif
                                        </span>
                                        </p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        @else
                            <div class="text-center">
                                {{ trans('global.no_alerts') }}
                            </div>
                        @endif

                        {{-- <a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Server down</span>&nbsp;registered</p><small class="notification-text"> USA Server is down due to hight CPU usage</small>
                                </div>
                            </div>
                        </a> --}}
                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="{{ route("admin.user-alerts.index") }}">Read all notifications</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{Auth::user()->name;}}</span><span class="user-status">{{Auth::user()->user_type;}}</span></div><span class="avatar">
                        <?php
                            $u_id=Auth::user()->id;
                            $tmp = App\Models\User::with([ 'roles'])->find($u_id);
                        ?>
                        <img class="round" src="{{ asset("app-assets/images/portrait/small/avatar-s-11.jpg") }}" alt="avatar" height="40" width="40"><span class="avatar-status-online">
                        </span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                
                    <a class="dropdown-item {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <!-- <i class="mr-50" data-feather="user"></i>  -->
                       <i class="mr-50" data-feather="user"></i>  {{ trans('Profile') }}
                    </a>
                @endcan
                @endif    
                    
                    <div class="dropdown-divider"></div>
                    <a onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="dropdown-item" href="#"><i class="mr-50" data-feather="power"></i> {{ trans('global.logout') }}</a>
                </div>
            </li>
        </ul>            
    </div>

      
    
</nav>
<!-- END: Header-->

    @include('partials.menu')

 <!-- BEGIN: Content-->
 <div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
       
                    @if(session('message'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            </div>
                        </div>
                    @endif
                    @if($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('content')

              
            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            
            
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>


    {{-- <script src="{{ asset('app-assets/js/scripts/pages/app-user-view.js') }}"></script> --}}

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <!--<script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>-->
    <!-- <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script> -->
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->
    <!-- BEGIN: Page JS-->
    <!--<script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>-->
    <!-- END: Page JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    
    <script src="{{ asset('app-assets/js/scripts/pages/app-todo.min.js') }}"></script>
    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('app-assets/js/scripts/pages/app-invoice-list.js') }}"></script>     --}}
    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('app-assets/js/scripts/pages/app-invoice.js') }}"></script> --}}
    <!-- END: Page JS-->    
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/tables/table-datatables-advanced.js') }}"></script>
    

    <!-- END: Page JS-->
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
    <!-- template extention end-->

    <script src="{{ asset('app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/dragula.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>

    <!-- quick admin panel template extention start-->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        
function btn(columns){
    return [
    {
        text: 'Select all',
        className: 'btn-primary',
        action: function (e,dt) {
        dt.rows().select();
        }
    },
    {
        text: 'Deselect all',
        className: 'btn-primary',
        action: function (e,dt) {
        dt.rows().deselect();
        }
    },
    // {
    //     extend: 'copy',
    //     text: 'Copy',
    //     className: 'btn buttons-copy buttons-html5 btn-default',
    //     charset: 'utf-8',
    //     extension: '.copy',
    //     exportOptions: {
    //     columns: columns,
    //     },        
    //     fieldSeparator: ';',
    //     fieldBoundary: '',
    //     filename: 'export',
    //     bom: true
    // },
    {
        extend: 'excelHtml5',
        text: 'Excel',
        className: 'btn buttons-excel buttons-html5 btn-default',
        charset: 'utf-8',
        exportOptions: {
        columns:columns,
        },
        fieldSeparator: ';',
        fieldBoundary: '',
        filename: 'export',
        bom: true
    },       
    {
        extend: 'pdfHtml5',
        text: 'PDF',
        className: 'btn buttons-pdf buttons-html5 btn-default',
        charset: 'utf-8',
        extension: '.pdf',
        exportOptions: {
        columns: columns,
        },
        fieldSeparator: ';',
        fieldBoundary: '',
        filename: 'export',
        bom: true
    },
    {
        extend: 'print',
        text: 'Print',
        className: 'btn buttons-print buttons-html5 btn-default',
        charset: 'utf-8',
        extension: '.print',
        exportOptions: {
        columns: columns,
        },
        fieldSeparator: ';',
        fieldBoundary: '',
        filename: 'export',
        bom: true
    }, 

]
}
        $(function() {
  let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
  let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
  let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
  let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
  let printButtonTrans = '{{ trans('global.datatables.print') }}'
  let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
  let selectAllButtonTrans = '{{ trans('global.select_all') }}'
  let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

  let languages = {
    'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
        'ar': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json'
  };

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })



  $.extend(true, $.fn.dataTable.defaults, {
    language: {
      url: languages['{{ app()->getLocale() }}'],
    },
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0
    }, {
        orderable: false,
        searchable: false,
        targets: -1
    }],
    select: {
      style:    'multi+shift',
      selector: 'td:first-child'
    },
    order: [],
    scrollX: true,
    pageLength: 100,
    dom: 'lBfrtip<"actions">',
    buttons: [
      {
        extend: 'selectAll',
        className: 'btn-primary',
        text: selectAllButtonTrans,
        exportOptions: {
          columns: ':visible'
        },
        action: function(e, dt) {
          e.preventDefault()
          dt.rows().deselect();
          dt.rows({ search: 'applied' }).select();
        }
      },
      {
        extend: 'selectNone',
        className: 'btn-primary',
        text: selectNoneButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
    
      {
        extend: 'csv',
        className: 'btn-default',
        text: csvButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'excel',
        className: 'btn-default',
        text: excelButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'pdf',
        className: 'btn-default',
        text: pdfButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
      {
        extend: 'print',
        className: 'btn-default',
        text: printButtonTrans,
        exportOptions: {
          columns: ':visible'
        }
      },
    ]
  });

  $.fn.dataTable.ext.classes.sPageButton = '';
});

    </script>
    <script>
        $(document).ready(function () {
    $(".notifications-menu").on('click', function () {
        if (!$(this).hasClass('open')) {
            $('.notifications-menu .label-warning').hide();
            $.get('/admin/user-alerts/read');
        }
    });
});

    </script>

<!-- insert switch status start-->
<script>
$(document).on("change",".approved_status",function(e){
    if($(this).is(":checked")){
        var status=1;
        $('#status_val').val(status);
    }else{
        var status=0;
        $('#status_val').val(status);
    }    
}); 
</script>
<!-- insert switch status end-->

<!-- update switch status start-->
<script>
$(document).on("change",".approved_status_update",function(e){
    if($(this).is(":checked")){
        var status=1;
        $('#update_status_val').val(status);
    }else{
        var status=0;
        $('#update_status_val').val(status);
    }    
}); 
</script>
<!-- update switch status end-->

<script>
$(document).on("change",".status_index",function(e){
  $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
      });
    var record_id=$(this).data("id");

    if($(this).is(":checked")){
        var status=1;
    }else{
        var status=0;
    }
       $.ajax({
            url: '{{route('admin.customers.update_status')}}',
             method:"POST",
             data:{record_id:record_id,status:status,modal_name:modal_name,field_name:field_name},
             dataType:"json",
             success:function(data)
             {
                 if(data.result=="1")
                 {
                     $(datable_class).DataTable().ajax.reload();    
                 }
   
               }
           });
}); 
</script>


    @yield('scripts')
</body>

</html>