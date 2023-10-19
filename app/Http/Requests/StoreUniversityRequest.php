<?php

namespace App\Http\Requests;

use App\University;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreUniversityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('university_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
            ],
        ];
    }
}
