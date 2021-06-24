<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'title'=>'required|max:250',
            'summary'=>'required|max:300',
            'slug'=>'required|unique:posts',
            'details'=>'required',
            // 'image'=>'image|mimes:jpg,gif,png|max:2048|dimensions:max_width=2000,max_height=1200',
            'image'=>'image|required',
            'category_id'=>'required',
        ];
    }
}
