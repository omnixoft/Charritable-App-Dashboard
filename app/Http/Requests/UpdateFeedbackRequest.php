<?php

namespace App\Http\Requests;

use App\Models\Feedback;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFeedbackRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('feedback_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
