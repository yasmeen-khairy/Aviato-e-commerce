<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class signupRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            
                'fname' => 'required|max:20|min:3|regex:/^[a-zA-Z]/',
                'lname' => 'required|max:20|min:3|regex:/^[a-zA-Z]/',
                'username' => 'required|max:20|min:3|regex:/^[a-zA-Z]/',
                'email' => 'required|email',
                'password' => 'required|max:10|min:3'
       
        ];
    }
}
