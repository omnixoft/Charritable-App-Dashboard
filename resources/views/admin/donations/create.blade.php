@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.donation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.donations.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.donation.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donation.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.donation.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donation.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.donation.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '') }}" step="1">
                @if($errors->has('amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donation.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="donation_type_id">{{ trans('cruds.donation.fields.donation_type') }}</label>
                <select class="form-control select2 {{ $errors->has('donation_type') ? 'is-invalid' : '' }}" name="donation_type_id" id="donation_type_id">
                    @foreach($donation_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('donation_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('donation_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('donation_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donation.fields.donation_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="number">{{ trans('cruds.donation.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="text" name="number" id="number" value="{{ old('number', '') }}">
                @if($errors->has('number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donation.fields.number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_id">{{ trans('cruds.donation.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donation.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="social_solidarity_id">{{ trans('cruds.donation.fields.social_solidarity') }}</label>
                <select class="form-control select2 {{ $errors->has('social_solidarity') ? 'is-invalid' : '' }}" name="social_solidarity_id" id="social_solidarity_id">
                    @foreach($social_solidarities as $id => $entry)
                        <option value="{{ $id }}" {{ old('social_solidarity_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('social_solidarity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('social_solidarity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donation.fields.social_solidarity_helper') }}</span>
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