<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdatePersonsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'max:255|required',
            'image' => 'required',
            'biography' => 'required',
            'birth_date' => 'required',
            'birth_place' => 'required',
            'sex' => 'required',
        ];
    }
}
