<?php

namespace App\Http\Requests;

use App\Models\SocialSolidarity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySocialSolidarityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('social_solidarity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:social_solidarities,id',
        ];
    }
}
