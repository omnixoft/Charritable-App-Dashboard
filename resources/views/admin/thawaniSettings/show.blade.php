@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.thawaniSetting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.thawani-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.thawaniSetting.fields.id') }}
                        </th>
                        <td>
                            {{ $thawaniSetting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.thawaniSetting.fields.url') }}
                        </th>
                        <td>
                            {{ $thawaniSetting->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.thawaniSetting.fields.secret_key') }}
                        </th>
                        <td>
                            {{ $thawaniSetting->secret_key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.thawaniSetting.fields.publish_key') }}
                        </th>
                        <td>
                            {{ $thawaniSetting->publish_key }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.thawani-settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection