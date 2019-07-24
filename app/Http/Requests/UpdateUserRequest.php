<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Session;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|email|unique:users,email,'.Session::get('userData')->id,
            'password' => 'required_with:new_password,min:6,confirmed,regex:/^(?=.*?[A-z])(?=.*?[0-9]).{6,}$/',
            'new_password' => 'required_with:password,min:6,confirmed,regex:/^(?=.*?[A-z])(?=.*?[0-9]).{6,}$/',
            'password_confirmation' => 'required_with:new_password|same:new_password',
        ];
    }

}
