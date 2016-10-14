<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TownRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return session('role') == 'greatAdmin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom' => 'required|not_in:commune',
            'district_id' => 'required|numeric|exists:district,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'description' => ''
         ];
    }
}
