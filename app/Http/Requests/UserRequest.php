<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
        $userId  = Auth::check() ? Auth::user()->id : null;

        if($isLogin) {
            return [
                'email'     => 'required',
                'password'  => 'required'
            ];
        } else {
            return [
                'name'      => 'required',
                'user_name' => 'required|unique:users',
                'email'     => 'required|email|unique:users,email,' .$userId,
                'password'  => 'required|min:6'
            ];
        }
        
    }
}