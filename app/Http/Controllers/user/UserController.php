<?php

namespace App\Http\Controllers\User;

use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Session;

class UserController extends Controller
{

    /**
     * @var $UserRepository
     * @var $UserService
     */
    protected $UserRepository;
    protected $UserService;

    /**
     *  Construct.
     *
     * @param $UserRepository
     * @param $UserService
     * @return void
     */
    public function __construct(UserRepository $UserRepository,UserService $UserService){
        $this->UserRepository = $UserRepository;
        $this->UserService = $UserService;
    }

    /**
     * User Dashboard.
     *
     * @return void
     */
    public function Dashboard(){

        $user = $this->UserRepository->find(Session::get('userData')->id);
        return view('user.dashboard',compact('user'));
    }

    /**
     * Edit User Profile.
     *
     * @return mixed
     */
    public function EditProfile(UpdateUserRequest $request){
        if($this->UserService->UpdateProfile($request->all())){
            toastr()->success('Success');
        }else{
            toastr()->error('Please write your password correctly');
        }
        return Redirect::back();
    }

    /**
     * Confirm your account.
     *
     * @return void
     */
    public function SendConfirmMail($id){
        if($this->UserService->SendConfirmMail($id)){
            toastr()->success('Please check your mail');
        }else{
            toastr()->error('Something is wrong!');
        }
        return Redirect(route('user.dashboard'));
    }
}
