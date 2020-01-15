<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\CreateEmployee;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Services\Employee\EmployeeService;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
        $this->middleware('auth:api');
    }

    public function index()
    {
        //
    }

    public function store(CreateEmployee $request)
    {
        $validated = $request->validated();

        return $this->employeeService->create($validated);
    }

    public function show($id)
    {
        return $this->employeeService->paginate();
    }

    public function update(CreateEmployee $request, $id)
    {
        $validated = $request->validated();
        $this->employeeService->update($validated, $id);

        return 'Employee has been updated succesfully';
    }

    public function destroy($id)
    {
        $this->employeeService->delete($id);
        return 'Deleted successfully';
    }
}
