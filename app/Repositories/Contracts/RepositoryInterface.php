<?php
namespace App\Repositories\Contracts;

interface RepositoryInterface
{

    /**
     * Get all instances of model.
     *
     * @return mixed
     */
    public function all();

    /**
     *  create a new record in the database.
     *
     * @param array
     */
    public function create(array $data);

    /**
     *  find record in the database.
     *
     * @param id
     */
    public function find($id);


    /**
     * update record in the database.
     *
     * @param array
     * @param id
     */
    public function update(array $data, $id);

    /**
     * remove record from the database
     *
     * @param id
     */
    public function delete($id);
}