<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return session('role') == "greatAdmin";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|not_in:region",
            "parent" => "required|numeric|exists:province,id",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "description" => "",
        ];
    }
}
