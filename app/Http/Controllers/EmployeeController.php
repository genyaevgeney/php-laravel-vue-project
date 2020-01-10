<?php

namespace App\Http\Controllers;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEmployee;
use App\Http\Controllers\Controller;
use App\Services\Employee\EmployeeService;

class EmployeeController extends Controller
{
	protected $user;
	protected $employeeService;

	public function __construct(EmployeeService $employeeService)
	{
		$this->employeeService = $employeeService;
		$this->user = JWTAuth::parseToken()->authenticate();
		
	}

    public function create(CreateEmployee $request)
    {
      $validated = $request->validated();
      
      return $this->employeeService->create($validated);
    }

    public function delete($id)
    {
     $this->employeeService->delete($id);
     return 'Deleted successfully';
    }

    public function paginate()
    {
     return $this->employeeService->paginate();
    }

    public function update(CreateEmployee $request, $id)
    {
     $validated = $request->validated();
     $this->employeeService->update($validated, $id);

     return 'Employee has been updated succesfully';
    }
}
