@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.donationtype.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.donationtypes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.donationtype.fields.id') }}
                        </th>
                        <td>
                            {{ $donationtype->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donationtype.fields.type') }}
                        </th>
                        <td>
                            {{ $donationtype->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donationtype.fields.type_ar') }}
                        </th>
                        <td>
                            {{ $donationtype->type_ar }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.donationtypes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection