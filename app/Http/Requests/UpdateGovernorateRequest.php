<?php

namespace App\Http\Requests;

use App\Models\Governorate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGovernorateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('governorate_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'name_ar' => [
                'string',
                'nullable',
            ],
        ];
    }
}
