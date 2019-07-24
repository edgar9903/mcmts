<?php
namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{

    /**
     *  find record in the database.
     *
     * @param email
     * @return void
     */
    public function login($email);


    /**
     *  Where record in the database.
     *
     * @param array $data
     * @return mixed
     */
    public function where(array $data);
}
