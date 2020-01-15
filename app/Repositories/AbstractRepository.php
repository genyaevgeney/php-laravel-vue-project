<?php
namespace App\Repositories;

class AbstractRepository implements AbstractInterface
{
    protected $model;

    public function create(array $attributes)
    {
        $data = $this->model->create($attributes);
        return $data;
    }

    public function getByName(string $name)
    {
        return $this->model->where('name', '=', $name)->get();
    }

    public function paginate(int $rowsCount)
    {
        return $this->model->paginate($rowsCount);
    }

    public function delete(int $id)
    {
        $item = $this->model->findOrFail($id);
        $item->delete();
    }

    public function update(array $attributes, int $id)
    {
        $object = $this->model->findOrFail($id);
        $object->update($attributes);
    }
}
