<?php
namespace App\Repositories\Employee;

use App\Repositories\AbstractRepository;
use App\Models\Employee;

class EmployeeRepository extends AbstractRepository implements EmployeeRepositoryInterface
{
    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }
}
