<?php

namespace App\Http\Requests\Tags;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|max:40|unique:tags,name,'.$this->tag->id
        ];
    }
}