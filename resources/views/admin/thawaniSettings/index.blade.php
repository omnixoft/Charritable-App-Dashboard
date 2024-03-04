@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            {{ trans('cruds.thawaniSetting.title_singular') }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route("admin.thawani-settings.insert") }}">
                    @if(isset($data->id))
                        <input type="hidden" name="id" value="{{ $data->id }}"/>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label class="required" for="url">{{ trans('cruds.thawaniSetting.fields.url') }}</label>
                        <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="<?= $data->url ?? '';?>" required>
                        @if($errors->has('url'))
                            <div class="invalid-feedback">
                                {{ $errors->first('url') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="secret_key">{{ trans('cruds.thawaniSetting.fields.secret_key') }}</label>
                        <input class="form-control {{ $errors->has('secret_key') ? 'is-invalid' : '' }}" type="text" name="secret_key" id="secret_key" value="{{$data->secret_key ?? '' }}" required>
                        @if($errors->has('secret_key'))
                            <div class="invalid-feedback">
                                {{ $errors->first('secret_key') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="publish_key">{{ trans('cruds.thawaniSetting.fields.publish_key') }}</label>
                        <input class="form-control {{ $errors->has('publish_key') ? 'is-invalid' : '' }}" type="text" name="publish_key" id="publish_key" value="{{ $data->publish_key?? '' }}" required>
                        @if($errors->has('publish_key'))
                            <div class="invalid-feedback">
                                {{ $errors->first('publish_key') }}
                            </div>
                        @endif
                    </div>
                        <input type="hidden" value="{{ $data->is_live?? '' }}" id="update_status_val" name="is_live">
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.thawaniSetting.fields.is_live') }}</label>
                            <div class="custom-control custom-switch custom-switch-success">
                            <input type="checkbox" class="custom-control-input approved_status_update" <?= isset($data->is_live) ? ($data->is_live==1 ? 'checked' : null) : '' ?>  id="customSwitch2_<?php echo $data->id ??'';?>" />
                            <label class="custom-control-label" for="customSwitch2_<?= $data->id??''?>">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                            </div>
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






