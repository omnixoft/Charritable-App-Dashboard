@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            {{ trans('cruds.contactUs.title_singular') }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route("admin.contactuses.store") }}">
                    @if(isset($data->id))
                        <input type="hidden" name="id" value="{{ $data->id }}"/>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label class="required" for="title">{{ trans('cruds.contactUs.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="<?= $data->title ?? '';?>" required>
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="title_ar">{{ trans('cruds.contactUs.fields.title_ar') }}</label>
                        <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{$data->title_ar ?? '' }}" required>
                        @if($errors->has('title_ar'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title_ar') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="hot_line">{{ trans('cruds.contactUs.fields.hot_line') }}</label>
                        <input class="form-control {{ $errors->has('hot_line') ? 'is-invalid' : '' }}" type="text" name="hot_line" id="hot_line" value="{{ $data->hot_line?? '' }}" required>
                        @if($errors->has('hot_line'))
                            <div class="invalid-feedback">
                                {{ $errors->first('hot_line') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="required" for="title">{{ trans('cruds.contactUs.fields.reception_line') }}</label>
                        <input class="form-control {{ $errors->has('reception_line') ? 'is-invalid' : '' }}" type="text" name="reception_line" id="reception_line" value="{{ $data->reception_line ?? ''}}" required>
                        @if($errors->has('reception_line'))
                            <div class="invalid-feedback">
                                {{ $errors->first('reception_line') }}
                            </div>
                        @endif
                    </div> 
                    <div class="form-group">
                        <label class="required" for="title">{{ trans('cruds.contactUs.fields.auditor_service_manager') }}</label>
                        <input class="form-control {{ $errors->has('auditor_service_manager') ? 'is-invalid' : '' }}" type="text" name="auditor_service_manager" id="auditor_service_manager" value="{{ $data->auditor_service_manager??''}}" required>
                        @if($errors->has('auditor_service_manager'))
                            <div class="invalid-feedback">
                                {{ $errors->first('auditor_service_manager') }}
                            </div>
                        @endif
                    </div>                                                           <div class="form-group">
                        <label class="required" for="title">{{ trans('cruds.contactUs.fields.fax') }}</label>
                        <input class="form-control {{ $errors->has('fax') ? 'is-invalid' : '' }}" type="text" name="fax" id="fax" value="{{$data->fax??''}}" required>
                        @if($errors->has('fax'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fax') }}
                            </div>
                        @endif
                    </div>  
                    <div class="form-group">
                        <label class="required" for="title">{{ trans('cruds.contactUs.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{$data->email??'' }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div> 
                    <div class="form-group">
                    <label class="required" for="address">{{ trans('cruds.contactUs.fields.address') }}</label>
                    <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{$data->address??'' }}</textarea>
                    @if($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.contactUs.fields.address_helper') }}</span>
                    </div>

                    <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="" for="branchName1">Branch Name1</label>
                                    <input type="text" name="branchName[]" class="form-control" id="branchName1" value="{{$branches[0]['name']??''}}" placeholder="branch Name">
                                </div>
                                <div class="form-group">
                                    <label class="" for="branchaddress1">Branch Address1</label>
                                    <input type="text" value="{{$branches[0]['branchaddress']??''}}" name="branchaddress[]" class="form-control" id="branchaddress1" placeholder="Branch Address1">
                                </div>
                                <div class="form-group">
                                    <label class="" for="address1">Telephone1</label>
                                    <input type="text" value="{{$branches[0]['telephone']??''}}" name="telephone[]" class="form-control" id="telephone1" placeholder="Telephone">
                                </div>
                                <div class="form-group">
                                    <label class="" for="pobox1">Pobox1</label>
                                    <input type="text" value="{{$branches[0]['pobox']??''}}" name="pobox[]" class="form-control" id="pobox1" placeholder="PoBox">
                                </div>
                                <div class="form-group">
                                    <label class="" for="postalcode1">PostalCode1</label>
                                    <input type="text" value="{{$branches[0]['postalcode']??''}}" name="postalcode[]" class="form-control" id="postalcode1" placeholder="PostalCode">
                                </div>
                                <div class="form-group">
                                    <label class="" for="branchEmail1">Branch Email1</label>
                                    <input type="email" value="{{$branches[0]['branchemail']??''}}" name="branchemail[]" class="form-control" id="branchEmail1" placeholder="Branch Email">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="branchName2" class="">Branch Name2</label>
                                    <input type="text" name="branchName[]" class="form-control"  value="{{$branches[1]['name']??''}}" id="branchName2" placeholder="branch Name">
                                </div>
                                <div class="form-group">
                                    <label class="" for="branchaddress2">Branch Address1</label>
                                    <input type="text" value="{{$branches[1]['branchaddress']??''}}" name="branchaddress[]" class="form-control" id="branchaddress2" placeholder="Branch Address2">
                                </div>
                                <div class="form-group">
                                    <label for="telephone2" class="">Telephone2</label>
                                    <input type="text" value="{{$branches[1]['telephone']??''}}" name="telephone[]" class="form-control" id="telephone2" placeholder="Telephone">
                                </div>
                                <div class="form-group">
                                    <label for="pobox2" class="">PoBox2</label>
                                    <input type="text" value="{{$branches[1]['pobox']??''}}" name="pobox[]" class="form-control" id="pobox2" placeholder="PoBox">
                                </div>
                                <div class="form-group">
                                    <label for="postalcode2">PostalCode2</label>
                                    <input type="text" value="{{$branches[1]['postalcode']??''}}" name="postalcode[]" class="form-control" id="postalcode2" placeholder="PostalCode">
                                </div>
                                <div class="form-group">
                                    <label class="" for="branchEmail2">Branch Email2</label>
                                    <input type="email" value="{{$branches[1]['branchemail']??''}}" name="branchemail[]" class="form-control" id="branchEmail2" placeholder="Branch Email">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="branchName3" class="">Branch Name3</label>
                                    <input type="text" value="{{$branches[2]['name']??''}}" name="branchName[]" class="form-control" id="branchName3" placeholder="branch Name">
                                </div>
                                <div class="form-group">
                                    <label class="" for="branchaddress3">Branch Address3</label>
                                    <input type="text" value="{{$branches[2]['branchaddress']??''}}" name="branchaddress[]" class="form-control" id="branchaddress3" placeholder="Branch Address3">
                                </div>
                                <div class="form-group">
                                    <label for="telephone3" class="">Telephone3</label>
                                    <input type="text" value="{{$branches[2]['telephone']??''}}" name="telephone[]" class="form-control" id="telephone3" placeholder="Telephone">
                                </div>
                                <div class="form-group">
                                    <label for="pobox3" class="">PoBox3</label>
                                    <input type="text" name="pobox[]" class="form-control" value="{{$branches[2]['pobox']??''}}" id="pobox3" placeholder="PoBox">
                                </div>
                                <div class="form-group">
                                    <label for="postalcode3" class="">PostalCode3</label>
                                    <input type="text" value="{{$branches[2]['postalcode']??''}}"  name="postalcode[]" class="form-control" id="postalcode3" placeholder="PostalCode">
                                </div>
                                <div class="form-group">
                                    <label for="branchEmail3" class="">Branch Email3</label>
                                    <input type="email" value="{{$branches[2]['branchemail']??''}}" name="branchemail[]" class="form-control" id="branchEmail3" placeholder="Branch Email">
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
    </div>
</div>
@endsection