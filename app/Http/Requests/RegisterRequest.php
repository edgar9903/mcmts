<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;


class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|email|unique:users',
            'username'  => 'required|unique:users',
            'password'  => 'required|min:6|confirmed|regex:/^(?=.*?[A-z])(?=.*?[0-9]).{6,}$/',
            'password_confirmation' => 'required|min:6',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {

        $validator->after(function ($validator) {
            if ( request('username') == request('password') ) {
                toastr()->error('Something is wrong!');
                $validator->errors()->add('password', 'your username and password is the same.');
            }
        });
        return;

    }
}
