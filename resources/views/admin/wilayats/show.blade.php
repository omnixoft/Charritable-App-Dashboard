@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.wilayat.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.wilayats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.wilayat.fields.id') }}
                        </th>
                        <td>
                            {{ $wilayat->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wilayat.fields.name') }}
                        </th>
                        <td>
                            {{ $wilayat->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wilayat.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $wilayat->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wilayat.fields.charges') }}
                        </th>
                        <td>
                            {{ $wilayat->charges!='' ? getOmr($wilayat->charges) : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.wilayat.fields.governorate') }}
                        </th>
                        <td>
                            {{ $wilayat->governorate->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.wilayats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection