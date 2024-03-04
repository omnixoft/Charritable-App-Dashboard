<?php

namespace App\Http\Requests;

use App\Models\Ayaht;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAyahtRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ayaht_create');
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
