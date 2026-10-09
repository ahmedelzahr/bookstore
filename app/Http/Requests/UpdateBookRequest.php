<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;


class UpdateBookRequest extends BaseBookRequest
{
  
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(Parent::rules(),[
            'cover_image'=>'nullable|image',
            'isbn'=>[Rule::unique('books','isbn')->ignore($this->book),'nullable','alpha_num']
        ]);
    }
}
