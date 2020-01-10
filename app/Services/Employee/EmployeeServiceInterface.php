<?php
namespace App\Services\Employee;
use App\Services\AbstractInterface;
interface EmployeeServiceInterface extends AbstractInterface
{
	public function create(array $data);

	public function update(array $data, int $id);
}