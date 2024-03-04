@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
           App Version Setting
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route("admin.app-version-settings.insert") }}">
                    @if(isset($data->id))
                        <input type="hidden" name="id" value="{{ $data->id }}"/>
                    @endif
                    @csrf

                    <div class="form-group">
                        <label class="required" for="secret_key">Android Version</label>
                        <input class="form-control {{ $errors->has('android') ? 'is-invalid' : '' }}"  type="number" step="0.01" name="android" id="android" value="{{$data->android ?? '' }}">
                        @if($errors->has('android'))
                            <div class="invalid-feedback">
                                {{ $errors->first('android') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="publish_key">IOS Version</label>
                        <input class="form-control {{ $errors->has('ios') ? 'is-invalid' : '' }}" type="number" name="ios" id="ios" value="{{ $data->ios?? '' }}">
                        @if($errors->has('ios'))
                            <div class="invalid-feedback">
                                {{ $errors->first('ios') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection






