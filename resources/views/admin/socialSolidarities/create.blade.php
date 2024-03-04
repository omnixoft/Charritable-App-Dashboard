@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.socialSolidarity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.social-solidarities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">{{ trans('cruds.socialSolidarity.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialSolidarity.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title_ar">{{ trans('cruds.socialSolidarity.fields.title_ar') }}</label>
                <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', '') }}">
                @if($errors->has('title_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialSolidarity.fields.title_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.socialSolidarity.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialSolidarity.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_ar">{{ trans('cruds.socialSolidarity.fields.description_ar') }}</label>
                <textarea class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar" id="description_ar">{{ old('description_ar') }}</textarea>
                @if($errors->has('description_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialSolidarity.fields.description_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="images_and_videos">{{ trans('cruds.socialSolidarity.fields.images_and_videos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('images_and_videos') ? 'is-invalid' : '' }}" id="images_and_videos-dropzone">
                </div>
                @if($errors->has('images_and_videos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('images_and_videos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialSolidarity.fields.images_and_videos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.socialSolidarity.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialSolidarity.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="donation_type_id">{{ trans('cruds.socialSolidarity.fields.donation_type') }}</label>
                <select class="form-control  {{ $errors->has('donation_type') ? 'is-invalid' : '' }}" name="donation_type_id" id="donation_type_id">
                    @foreach($donation_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('donation_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('donation_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('donation_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialSolidarity.fields.donation_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="team_id">{{ trans('Charity') }}</label>
                <select class="form-control  {{ $errors->has('team_id') ? 'is-invalid' : '' }}" name="team_id" id="team_id">
                    @foreach($charity as $id => $entry)
                        <option value="{{ $id }}" {{ old('team_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('team_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('team_id') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="target_amount">{{ trans('cruds.socialSolidarity.fields.target_amount') }}</label>
                <input class="form-control {{ $errors->has('target_amount') ? 'is-invalid' : '' }}" type="number" name="target_amount" id="target_amount" value="{{ old('target_amount', '') }}" step="1">
                @if($errors->has('target_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('target_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.socialSolidarity.fields.target_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <input type="hidden" value="0" id="status_val" name="active">
                <div class="form-group">
                    <label>{{ trans('cruds.socialSolidarity.fields.active') }}</label>
                    <div class="custom-control custom-switch custom-switch-success">
                    <input type="checkbox"  class="custom-control-input approved_status"  id="customSwitch2_1"/>
                    <label class="custom-control-label" for="customSwitch2_1">
                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                    </label>
                    </div>
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



@endsection

@section('scripts')
<script>
    var uploadedImagesAndVideosMap = {}
Dropzone.options.imagesAndVideosDropzone = {
    url: '{{ route('admin.social-solidarities.storeMedia') }}',
    maxFilesize: 200, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 200
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="images_and_videos[]" value="' + response.name + '">')
      uploadedImagesAndVideosMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesAndVideosMap[file.name]
      }
      $('form').find('input[name="images_and_videos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($socialSolidarity) && $socialSolidarity->images_and_videos)
          var files =
            {!! json_encode($socialSolidarity->images_and_videos) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="images_and_videos[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection