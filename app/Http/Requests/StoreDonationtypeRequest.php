<?php

namespace App\Http\Requests;

use App\Models\Donationtype;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDonationtypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('donationtype_create');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'required',
            ],
        ];
    }
}
