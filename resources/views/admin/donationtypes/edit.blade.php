@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.donationtype.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.donationtypes.update", [$donationtype->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="type">{{ trans('cruds.donationtype.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $donationtype->type) }}" required>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donationtype.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="type_ar">{{ trans('cruds.donationtype.fields.type_ar') }}</label>
                <input class="form-control {{ $errors->has('type_ar') ? 'is-invalid' : '' }}" type="text" name="type_ar" id="type_ar" value="{{ old('type_ar', $donationtype->type_ar) }}" required>
                @if($errors->has('type_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donationtype.fields.type_ar_helper') }}</span>
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