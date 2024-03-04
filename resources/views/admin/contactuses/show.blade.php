@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contactUs.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contactuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUs.fields.id') }}
                        </th>
                        <td>
                            {{ $contactUs->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUs.fields.title') }}
                        </th>
                        <td>
                            {{ $contactUs->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUs.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $contactUs->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUs.fields.hot_line') }}
                        </th>
                        <td>
                            {{ $contactUs->hot_line }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUs.fields.reception_line') }}
                        </th>
                        <td>
                            {{ $contactUs->reception_line }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUs.fields.auditor_service_manager') }}
                        </th>
                        <td>
                            {{ $contactUs->auditor_service_manager }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUs.fields.fax') }}
                        </th>
                        <td>
                            {{ $contactUs->fax }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contactUs.fields.email') }}
                        </th>
                        <td>
                            {{ $contactUs->email }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.contactuses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection