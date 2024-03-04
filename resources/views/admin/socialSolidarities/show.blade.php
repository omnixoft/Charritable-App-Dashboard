@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.socialSolidarity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.social-solidarities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.socialSolidarity.fields.id') }}
                        </th>
                        <td>
                            {{ $socialSolidarity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialSolidarity.fields.title') }}
                        </th>
                        <td>
                            {{ $socialSolidarity->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialSolidarity.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $socialSolidarity->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialSolidarity.fields.description') }}
                        </th>
                        <td>
                            {{ $socialSolidarity->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialSolidarity.fields.description_ar') }}
                        </th>
                        <td>
                            {{ $socialSolidarity->description_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialSolidarity.fields.images_and_videos') }}
                        </th>
                        <td>
                            @foreach($socialSolidarity->images_and_videos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialSolidarity.fields.date') }}
                        </th>
                        <td>
                            {{ $socialSolidarity->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialSolidarity.fields.donation_type') }}
                        </th>
                        <td>
                            {{ $socialSolidarity->donation_type->type ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialSolidarity.fields.target_amount') }}
                        </th>
                        <td>
                            {{ $socialSolidarity->target_amount!='' ? getOmr($socialSolidarity->target_amount) : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.socialSolidarity.fields.active') }}
                        </th>
                        <td>
                            {{ App\Models\SocialSolidarity::ACTIVE_RADIO[$socialSolidarity->active] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.social-solidarities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection