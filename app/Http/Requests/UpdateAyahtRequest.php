<?php

namespace App\Http\Requests;

use App\Models\Ayaht;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAyahtRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ayaht_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'title_ar' => [
                'string',
                'nullable',
            ],
            'refrence' => [
                'string',
                'nullable',
            ],
            'refrence_ar' => [
                'string',
                'nullable',
            ],
        ];
    }
}
