<?php
namespace App\Repositories;

interface AbstractInterface
{
    public function getByName(string $name);
    public function update(array $attributes, int $id);
    public function paginate(int $rowsCount);
    public function delete(int $id);
    public function create(array $attributes);
}
