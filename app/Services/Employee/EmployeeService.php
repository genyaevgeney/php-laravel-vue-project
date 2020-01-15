<?php

namespace App\Services\Employee;

use App\Exceptions\UpdateException;
use App\Http\Resources\Employee\EmployeeResource;
use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\Company\CompanyRepository;
use App\Services\AbstractService;
use App\Mail\MailtrapExample;
use Illuminate\Support\Facades\Mail;

class EmployeeService extends AbstractService implements EmployeeServiceInterface
{
    protected $companyRepository;
    protected $paginationRowsCount;
    
    public function __construct(EmployeeRepository $employeeRepository, CompanyRepository $companyRepository)
    {
        $this->repository = $employeeRepository;
        $this->companyRepository = $companyRepository;
        $this->paginationRowsCount = 10;
    }
    
    public function create(array $data)
    {
        $dataArr = $this->companyRepository->getByName($data['companyName']);
        // return $employeeObj;
        $data = $this->repository->create(['name' => $data['name'],
            'address' => $data['address'],
            'companyName' => $dataArr[0]->name,
            'company_id' => $dataArr[0]->id]);
        Mail::to($dataArr[0]->email)->send(new MailtrapExample());
        return $data;
    }

    public function update(array $data, int $id)
    {
        $dataArr = $this->companyRepository->getByName($data['companyName']);
        if (!isset($dataArr[0])) {
            return "A company with this name has not been created.";
        }
        $employeeObj = ['name' => $data['name'],
        'address' => $data['address'],
        'company_id' => $dataArr[0]->id];
        $this->repository->update($employeeObj, $id);
    }
}
