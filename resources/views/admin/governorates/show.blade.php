@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.governorate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.governorates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.governorate.fields.id') }}
                        </th>
                        <td>
                            {{ $governorate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.governorate.fields.name') }}
                        </th>
                        <td>
                            {{ $governorate->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.governorate.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $governorate->name_ar }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.governorates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection