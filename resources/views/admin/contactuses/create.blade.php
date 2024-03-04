@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contactUs.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contactuses.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.contactUs.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUs.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title_ar">{{ trans('cruds.contactUs.fields.title_ar') }}</label>
                <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', '') }}">
                @if($errors->has('title_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUs.fields.title_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="hot_line">{{ trans('cruds.contactUs.fields.hot_line') }}</label>
                <input class="form-control {{ $errors->has('hot_line') ? 'is-invalid' : '' }}" type="text" name="hot_line" id="hot_line" value="{{ old('hot_line', '') }}">
                @if($errors->has('hot_line'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hot_line') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUs.fields.hot_line_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reception_line">{{ trans('cruds.contactUs.fields.reception_line') }}</label>
                <input class="form-control {{ $errors->has('reception_line') ? 'is-invalid' : '' }}" type="text" name="reception_line" id="reception_line" value="{{ old('reception_line', '') }}">
                @if($errors->has('reception_line'))
                    <div class="invalid-feedback">
                        {{ $errors->first('reception_line') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUs.fields.reception_line_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="auditor_service_manager">{{ trans('cruds.contactUs.fields.auditor_service_manager') }}</label>
                <input class="form-control {{ $errors->has('auditor_service_manager') ? 'is-invalid' : '' }}" type="text" name="auditor_service_manager" id="auditor_service_manager" value="{{ old('auditor_service_manager', '') }}">
                @if($errors->has('auditor_service_manager'))
                    <div class="invalid-feedback">
                        {{ $errors->first('auditor_service_manager') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUs.fields.auditor_service_manager_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fax">{{ trans('cruds.contactUs.fields.fax') }}</label>
                <input class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" type="text" name="fax" id="fax" value="{{ old('fax', '') }}">
                @if($errors->has('fax'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fax') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUs.fields.fax_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.contactUs.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contactUs.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection