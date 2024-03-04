<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('customer_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                // 'required',
                'string',
                // 'unique:customers,email,' . request()->route('customer')->id,
            ],
            'phone' => [
                'string',
                // 'min:10',
                // 'max:14',
                'nullable',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
