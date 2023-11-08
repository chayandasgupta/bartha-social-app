<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $isLogin = $this->is('login');

        if($isLogin) {
            return [
                'email'     => 'required',
                'password'  => 'required'
            ];
        } else {
            return [
                'name'      => 'required',
                'user_name' => 'required|unique:users',
                'email'     => 'required|email|unique:users',
                'password'  => 'required|min:6'
            ];
        }
        
    }
}