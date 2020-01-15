<?php
namespace App\Services;
class AbstractService implements AbstractInterface
{
	protected $repository;

	public function delete(int $id)
    {
        $this->repository->delete($id);
    }

    public function paginate()
    {
        return $this->repository->paginate($this->paginationRowsCount);
    }
}