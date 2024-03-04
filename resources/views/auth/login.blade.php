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
                    <h2 class="card-title font-weight-bold mb-1">Welcome to {{ trans('panel.site_title') }} 👋</h2>
                    <p class="card-text mb-2">Please {{ trans('global.login') }} to your account and start the adventure</p>
                    @if(session('message'))
                        <div class="alert alert-info" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif



                        <form method="POST" action="{{ route('login') }}" class="auth-login-form mt-2">
                            @csrf
        
                        <div class="form-group">
                            <label class="form-label" for="login-email">Email</label>
                            <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
    
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="login-password">Password</label><a href="{{ route('password.request') }}"><small>   {{ trans('global.forgot_password') }}</small></a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                  
                            <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-merge" required placeholder="{{ trans('global.login_password') }}">
    
                           
                                <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                            </div>
                            @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" id="remember-me"  name="remember" type="checkbox" tabindex="3" />
                                <label class="custom-control-label" for="remember-me">    {{ trans('global.remember_me') }}</label>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" tabindex="4">  {{ trans('global.login') }}</button>
                    </form>
 
                    <p class="text-center mt-2"><span>New on our platform?</span><a href="{{ route('register') }}"><span>&nbsp;   {{ trans('global.register') }}</span></a></p>
                    {{-- <div class="divider my-2">
                        <div class="divider-text">or</div>
                    </div> --}}
                    {{-- <div class="auth-footer-btn d-flex justify-content-center"><a class="btn btn-facebook" href="javascript:void(0)"><i data-feather="facebook"></i></a><a class="btn btn-twitter white" href="javascript:void(0)"><i data-feather="twitter"></i></a><a class="btn btn-google" href="javascript:void(0)"><i data-feather="mail"></i></a><a class="btn btn-github" href="javascript:void(0)"><i data-feather="github"></i></a></div> --}}
                </div>
            </div>
            <!-- /Login-->
        </div>
    </div>
</div>

@endsection