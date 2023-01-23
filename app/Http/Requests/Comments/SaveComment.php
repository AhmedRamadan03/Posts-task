<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class SaveComment extends FormRequest
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
    public function rules(){
        return [
            'comment' =>'required|string|min:20',
            'post_id' =>'required',
        ];
    }

    public function messages (){
        return [
            'comment.required'=>'this input must be require',
            'min' => 'Comment must be bigger then 20 chr'
        ];
    }

}
