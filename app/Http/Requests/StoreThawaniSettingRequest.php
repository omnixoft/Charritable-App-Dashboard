<?php

namespace App\Http\Requests;

use App\Models\ThawaniSetting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreThawaniSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('thawani_setting_create');
    }

    public function rules()
    {
        return [
            'url' => [
                'string',
                'nullable',
            ],
            'secret_key' => [
                'string',
                'nullable',
            ],
            'publish_key' => [
                'string',
                'nullable',
            ],
        ];
    }
}
