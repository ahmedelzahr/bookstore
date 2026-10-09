<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends BaseBookRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
    {
        return array_merge(Parent::rules(),[
            'cover_image'=>'required|image',
            'isbn'=>[Rule::unique('books','isbn'),'nullable','alpha_num']
        ]);
    }
}
