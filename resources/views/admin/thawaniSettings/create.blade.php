@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.thawaniSetting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.thawani-settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="url">{{ trans('cruds.thawaniSetting.fields.url') }}</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', '') }}">
                @if($errors->has('url'))
                    <div class="invalid-feedback">
                        {{ $errors->first('url') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.thawaniSetting.fields.url_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="secret_key">{{ trans('cruds.thawaniSetting.fields.secret_key') }}</label>
                <input class="form-control {{ $errors->has('secret_key') ? 'is-invalid' : '' }}" type="text" name="secret_key" id="secret_key" value="{{ old('secret_key', '') }}">
                @if($errors->has('secret_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('secret_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.thawaniSetting.fields.secret_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="publish_key">{{ trans('cruds.thawaniSetting.fields.publish_key') }}</label>
                <input class="form-control {{ $errors->has('publish_key') ? 'is-invalid' : '' }}" type="text" name="publish_key" id="publish_key" value="{{ old('publish_key', '') }}">
                @if($errors->has('publish_key'))
                    <div class="invalid-feedback">
                        {{ $errors->first('publish_key') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.thawaniSetting.fields.publish_key_helper') }}</span>
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