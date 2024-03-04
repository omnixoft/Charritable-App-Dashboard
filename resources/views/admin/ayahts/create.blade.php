@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.ayaht.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ayahts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.ayaht.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ayaht.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title_ar">{{ trans('cruds.ayaht.fields.title_ar') }}</label>
                <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', '') }}">
                @if($errors->has('title_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ayaht.fields.title_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ayaht">{{ trans('cruds.ayaht.fields.ayaht') }}</label>
                <textarea class="form-control {{ $errors->has('ayaht') ? 'is-invalid' : '' }}" name="ayaht" id="ayaht">{{ old('ayaht') }}</textarea>
                @if($errors->has('ayaht'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ayaht') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ayaht.fields.ayaht_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="translation">{{ trans('cruds.ayaht.fields.translation') }}</label>
                <textarea class="form-control {{ $errors->has('translation') ? 'is-invalid' : '' }}" name="translation" id="translation">{{ old('translation') }}</textarea>
                @if($errors->has('translation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('translation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ayaht.fields.translation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="refrence">{{ trans('cruds.ayaht.fields.refrence') }}</label>
                <input class="form-control {{ $errors->has('refrence') ? 'is-invalid' : '' }}" type="text" name="refrence" id="refrence" value="{{ old('refrence', '') }}">
                @if($errors->has('refrence'))
                    <div class="invalid-feedback">
                        {{ $errors->first('refrence') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ayaht.fields.refrence_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="refrence_ar">{{ trans('cruds.ayaht.fields.refrence_ar') }}</label>
                <input class="form-control {{ $errors->has('refrence_ar') ? 'is-invalid' : '' }}" type="text" name="refrence_ar" id="refrence_ar" value="{{ old('refrence_ar', '') }}">
                @if($errors->has('refrence_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('refrence_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ayaht.fields.refrence_ar_helper') }}</span>
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