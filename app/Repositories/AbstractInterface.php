<?php
namespace App\Repositories;
interface AbstractInterface
{
    // /**
    //  * @param int $id
    //  * @return mixed
    //  */
    // public function getById(int $id);
    // /**
    //  * @param int $limit
    //  * @return mixed
    //  */
    // public function getAll(int $limit = 10);
    // /**
    //  * @return mixed
    //  */
    // public function getAllNoLimit();
    // *
    //  * @param int $id
    //  * @param array $attributes
    //  * @param bool $getDataBack
    //  * @return mixed
     public function getByName(string $name);
    public function update(array $attributes, int $id);
    public function paginate(int $rowsCount);
    // /**
    //  * @param int $id
    //  * @return mixed
    //  */
    public function delete(int $id);
    // /**
    //  * @param array $attributes
    //  * @return mixed
    //  */
    public function create(array $attributes);
}