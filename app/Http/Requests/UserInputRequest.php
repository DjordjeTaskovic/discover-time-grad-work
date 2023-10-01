<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInputRequest extends FormRequest
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
            'dzUsername' => 'required|max:30|min:2',
            'dzEmail' => 'required|email|',
            'dzPassword' => 'required|min:8',
        ];
    }

    public function messages(){
        return [
             'required' => 'The :attribute field is required.',
             'username.min' => 'Firstame must be longer than :min characters.',
             'password.min' => 'Password must be longer than :min characters.',
             'email'=>'Email must be right.'

        ];
    }
}