<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateMoviesRequest extends Request
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
            'title' => 'max:255|required',
            'genres' => 'required',
            'overview' => 'required',
            'poster' => 'required',
            'trailer' => 'max:255|required',
            'runtime' => 'required',
            'director' => 'required',
            'writers' => 'required',
            'release_date' => 'required',
            'language' => 'required',
            'budget' => 'required',
        ];
    }
}
