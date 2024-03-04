@extends('layouts.app')
@section('content')

<div class="content-body">
    <div class="auth-wrapper auth-v2">
        <div class="auth-inner row m-0">
            <!-- Brand logo--><a class="brand-logo" href="javascript:void(0);">
                <img src="{{ asset("logo.png") }}" width="60">
                <h2 class="brand-text text-primary ml-1" style="line-height:51px">{{ trans('panel.site_title') }}</h2>
            </a>
            <!-- /Brand logo-->
            <!-- Left Text-->
            <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{ asset("app-assets/images/pages/login-v2.svg") }}" alt="Login V2" /></div>
            </div>
            <!-- /Left Text-->
            <!-- Login-->
            <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                    <h2 class="card-title font-weight-bold mb-1">Contact Us</h2>
                    @if(session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                        <form action="" class="mt-2">                            
                        <div class="form-group">
                            <label class="form-label" for="login-title">Title</label>
                            <input id="title" name="title" type="text" class="form-control" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="login-body">body</label>
                            </div>
                            <div class="input-group input-group-merge form-body-toggle">
                            <textarea id="body" name="body" type="body" class="form-control form-control-merge"></textarea> 
                        </div>
                        <button class="mt-1 btn btn-primary btn-block" tabindex="4">Submit</button>
                    </form>
                </div>
            </div>
            <!-- /Login-->
        </div>
    </div>
</div>

@endsection