<?php

namespace App\Repositories;

use App\User;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface
{

    /**
     * @var User
     */
    protected $model;

    /**
     *  Construct.
     *
     * @param $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     *  Find record in the database.
     *
     * @param $email
     * @return mixed
     */
    public function login($email)
    {
        return  $this->model->where('email',$email)->orWhere('username',$email)->first();
    }

    /**
     *  Where record in the database.
     *
     * @param array $data
     * @return mixed
     */
    public function where(array $data)
    {
        return  $this->model->where($data)->get();
    }

}