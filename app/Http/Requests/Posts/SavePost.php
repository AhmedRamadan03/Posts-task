<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SavePost extends FormRequest
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
            'title' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/u',
                'max:150',
                Rule::unique('posts', 'title')->ignore($this->route('post')),
            ],
            'content' => 'required|string|min:20',
            'image' => 'nullable|image|mimes:png,jpg,weba|max:2048',
        ];

    }

    public function messages (){
        return [
            'title.required'=>'this input must be require',
            'content.required'=>'this input must be require',
            'string'=>'this input must be string',
            'image' => 'this input must be image with type jpg,weba,png',
            'unique' => 'this input must be unique',
            'regex' => 'title accept only letter',
        ];
    }

}
