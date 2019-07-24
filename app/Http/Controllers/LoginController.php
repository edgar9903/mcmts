<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Usergroup;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Redirect;
use Session;

class LoginController extends Controller
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
     * Check usergroup.
     *
     * @return mixed
     */
    public function check(){

        if($user = Session::get('userData')){

            $usergroup = Usergroup::where('usergroup','admin')->first();
            if($user->usergroup == $usergroup->id) {

                return Redirect('/admin/dashboard');
            }else {

                return Redirect('/user/dashboard');
            }
        }

        return Redirect(route('login.view'));
    }

    /**
     * Logout.
     *
     * @return void
     */
    public function Logout(){
        Session::forget('userData');
        return Redirect('/');
    }

    /**
     * Check login .
     *
     * @return void
     */
    public function Login(LoginRequest $request){
        $this->UserService->CheckLogin($request->only(['email', 'password']));
        return redirect('/');
    }

    /**
     * Check Register .
     *
     * @return void
     */
    public function Register(RegisterRequest $request){
        $this->UserService->CheckRegister($request->all());
        return Redirect(route('login.view'));
    }

    /**
     * Confirm profile.
     *
     * @param $id
     * @param $validate
     * @return void
     */
    public function Confirm($id,$validate){
        if($this->UserService->Confirm($id,$validate)){

            toastr()->success('Success');
            return Redirect('/');
        }else{

            toastr()->error('Something is wrong!');
            return Redirect('/');

        }


    }

}
