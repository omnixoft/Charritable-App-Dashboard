@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.donation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.donations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.donation.fields.id') }}
                        </th>
                        <td>
                            {{ $donation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donation.fields.user') }}
                        </th>
                        <td>
                            {{ $donation->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donation.fields.date') }}
                        </th>
                        <td>
                            {{ $donation->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donation.fields.amount') }}
                        </th>
                        <td>
                            {{ $donation->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donation.fields.donation_type') }}
                        </th>
                        <td>
                            {{ $donation->donation_type->type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donation.fields.number') }}
                        </th>
                        <td>
                            {{ $donation->number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donation.fields.company') }}
                        </th>
                        <td>
                            {{ $donation->company->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donation.fields.social_solidarity') }}
                        </th>
                        <td>
                            {{ $donation->social_solidarity->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.donations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection