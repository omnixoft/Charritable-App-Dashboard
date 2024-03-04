@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.wilayat.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.wilayats.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.wilayat.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wilayat.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_ar">{{ trans('cruds.wilayat.fields.name_ar') }}</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', '') }}">
                @if($errors->has('name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wilayat.fields.name_ar_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label for="charges">{{ trans('cruds.wilayat.fields.charges') }}</label>
                <input class="form-control {{ $errors->has('charges') ? 'is-invalid' : '' }}" type="number" name="charges" id="charges" value="{{ old('charges', '') }}" step="1">
                @if($errors->has('charges'))
                    <div class="invalid-feedback">
                        {{ $errors->first('charges') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wilayat.fields.charges_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="governorate_id">{{ trans('cruds.wilayat.fields.government') }}</label>
                <select class="form-control  {{ $errors->has('governorate') ? 'is-invalid' : '' }}" name="governorate_id" id="governorate_id">
                    @foreach($governorates as $id => $entry)
                        <option value="{{ $id }}" {{ old('governorate_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('governorate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('governorate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.wilayat.fields.governorate_helper') }}</span>
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