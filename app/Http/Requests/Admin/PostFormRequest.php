<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required','string'],
            'subProgram' => ['required'],
            'Program_id'=> ['required','integer'],
            'postType' => ['required'],
            'slug'=> ['required','string'],
            'description' => ['required'],
            'yt_iframe'=>['nullable','string'],
            'meta_title'=>['string','required'],
            'meta_description'=>['string','nullable'],
            'meta_keyword'=>['string','nullable'],
            'status'=>'nullable',

        ];

        return $rules;
    }
}
