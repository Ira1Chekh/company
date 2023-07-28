<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'users' => ['nullable', 'array'],
            'users.*' => ['required', 'exists:users,id']
        ];
    }

}
