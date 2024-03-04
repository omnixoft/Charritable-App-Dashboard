<?php

namespace App\Http\Requests;

use App\Models\Donationtype;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDonationtypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('donationtype_edit');
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
