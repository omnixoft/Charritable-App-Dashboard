@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ayaht.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ayahts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ayaht.fields.id') }}
                        </th>
                        <td>
                            {{ $ayaht->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ayaht.fields.title') }}
                        </th>
                        <td>
                            {{ $ayaht->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ayaht.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $ayaht->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ayaht.fields.ayaht') }}
                        </th>
                        <td>
                            {{ $ayaht->ayaht }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ayaht.fields.translation') }}
                        </th>
                        <td>
                            {{ $ayaht->translation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ayaht.fields.refrence') }}
                        </th>
                        <td>
                            {{ $ayaht->refrence }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ayaht.fields.refrence_ar') }}
                        </th>
                        <td>
                            {{ $ayaht->refrence_ar }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ayahts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection