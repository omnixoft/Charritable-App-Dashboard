<?php

namespace App\Http\Requests;

use App\Models\Wilayat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWilayatRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('wilayat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:wilayats,id',
        ];
    }
}
