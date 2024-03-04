<?php

namespace App\Http\Requests;

use App\Models\SocialSolidarity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSocialSolidarityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('social_solidarity_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
                'max:191',
            ],
            'title_ar' => [
                'string',
                'nullable',
                'max:191',
            ],
            'images_and_videos' => [
                'array',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'target_amount' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}