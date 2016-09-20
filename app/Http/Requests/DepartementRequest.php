<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return session('role') == "greatAdmin" || sessiont('role') == 'redactor';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|not_in:departement|string',
            'parent'=>"required|numeric|exists:region,id",
            'longitude'=>'required|numeric',
            'latitude'=>'required|numeric',
            'description'=>''
        ];
    }
}
