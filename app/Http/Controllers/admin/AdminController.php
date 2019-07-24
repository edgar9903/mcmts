<?php

namespace App\Http\Controllers\admin;

use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Session;

class AdminController extends Controller
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

        $users = $this->UserService->GetAllUsers();
        return view('admin.dashboard',compact('users'));
    }


    /**
     * User Info.
     *
     * @param $id
     * @return void
     */
    public function UserInfo($id){

        $user = $this->UserRepository->find($id);
        return view('admin.userinfo',compact('user'));
    }

    /**
     * User Update.
     *
     * @return void
     */
    public function UserUpdate(Request $request){

        $this->UserService->UpdateInfo($request->all());
        $users = $this->UserService->GetAllUsers();
        return view('admin.dashboard',compact('users'));
    }

    /**
     * User Delete.
     *
     * @param $id
     * @return void
     */
    public function DeleteUser($id){

        $this->UserRepository->delete($id);
        $users = $this->UserService->GetAllUsers();
        return view('admin.dashboard',compact('users'));
    }



}
