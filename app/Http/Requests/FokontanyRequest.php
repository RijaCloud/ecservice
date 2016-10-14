<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FokontanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return session('role') == "greatAdmin" || session('role') == "redactor";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom'=>'required|string|not_in:fokontany',
            'description'=>'',
            'longitude'=>'required|numeric',
            'latitude'=>'required|numeric',
            'commune_id'=>'required|numeric|exists:commune,id'
        ];
    }
}
