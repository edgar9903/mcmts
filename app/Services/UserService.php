<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Usergroup;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Session;
use Mail;

class UserService
{

    /**
     * @var UserRepository
     */
    protected $UserRepository;


    /**
     *  Construct.
     *
     * @param $UserRepository
     * @return void
     */
    public function __construct(UserRepository $UserRepository){
        $this->UserRepository = $UserRepository;
    }


    /**
     * check login.
     *
     * @param array $data
     * @return boolean
     */
    public function CheckLogin(array $data){
        if ($user = $this->UserRepository->login($data['email'])){
            if ($user->password == md5(md5($data['password']).''.$user->salt)){
                Session::put('userData', $user);
                return true;
            }
        }
        return false;
    }

    /**
     * check register.
     *
     * @param array $data
     * @return void
     */
    public function CheckRegister(array $data){
        unset(
            $data['_token'],
            $data['password_confirmation']
        );

        $salt = Str::random(rand(4,8));
        $validation_string = Str::random(20);
        $usergroup = Usergroup::where('usergroup','user')->first();
        $data['salt'] = $salt;
        $data['validation_string'] = $validation_string;
        $data['password'] = md5(md5($data['password']).''.$salt);
        $data['usergroup'] = $usergroup->id;
        $user = $this->UserRepository->create($data);

        $this->SendConfirmMail($user->id);

    }

    /**
     * Update User Profile.
     *
     * @param array $data
     * @return boolean
     */
    public function UpdateProfile(array $data)
    {

        $user = $this->UserRepository->find(Session::get('userData')->id);

        if (!is_null($data['password'])){

            if (md5(md5($data['password']).''.$user->salt) == $user->password){

                $data['password'] =  md5(md5($data['new_password']).''.$user->salt);
            }else{
                return false;
            }


            unset(
                $data['_token'],
                $data['_method'],
                $data['password_confirmation'],
                $data['new_password']
            );

        }else{

            unset(
                $data['_token'],
                $data['_method'],
                $data['password'],
                $data['password_confirmation'],
                $data['new_password']
            );
        }

        if ($data['email'] != $user->email){

            $data['email_validation'] = 0;
            $data['validation_string'] = Str::random(20);
        }

        $this->UserRepository->update($data,$user->id);

        return true;

    }

    /**
     * Send confirm Mail.
     *
     * @param $id
     * @return boolean
     */
    public function SendConfirmMail($id){
        if ($user = $this->UserRepository->find($id)){

            $data = [
                'id' => $user->id,
                'validate' => $user->validation_string,
                'name' => $user->username,
            ];

            Mail::send(['html' => 'email.confirm_mail'], $data, function ($message) use ($user){
                $message->from('edgar.kirakosyan19@gmial.com', 'mcmts');
                $message->to($user->email,$user->name)->subject('verify email address ');
            });

            return true;

        }

        return false;

    }

    /**
     * check register.
     *
     * @param $id
     * @param $validate
     * @return boolean
     */
    public function Confirm($id,$validate){
        if ($user = $this->UserRepository->find($id)){

            if ($user->validation_string == $validate){

                $data = [
                    'email_validation' => true,
                ];
                $this->UserRepository->update($data,$id);

                return true;
            }
        }

        return false;
    }

    /**
     * Get All users
     *
     * @return array
     */
    public function GetAllUsers(){

        $usergroup = Usergroup::where('usergroup','user')->first();
        $users = $this->UserRepository->where(['usergroup' => $usergroup->id]);

        return $users;
    }

    /**
     * Update user info
     *
     * @param array $data
     * @return boolean
     */
    public function UpdateInfo(array $data){

        $id = Crypt::decrypt($data['id']);
        if ($user = $this->UserRepository->find($id)) {

            unset(
                $data['_token'],
                $data['_method'],
                $data['id']

            );

            $this->UserRepository->update($data, $user->id);

            return true;
        }

        return false;

    }




}