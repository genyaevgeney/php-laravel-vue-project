<?php

namespace App\Services\Company;
use App\Exceptions\UpdateException;
use App\Http\Resources\Company\CompanyResource;
use App\Repositories\Company\CompanyRepository;
use App\Services\AbstractService;
class CompanyService extends AbstractService implements CompanyServiceInterface
{
    protected $repository;
    protected $paginationRowsCount;
    /**
     * CompanyService constructor.
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->repository = $companyRepository;
        $this->paginationRowsCount = 10;
    }
    /**
     * Create a new user instance.
     * @param array $data
     * @return mixed
     */
    public function create(array $data, object $request)
    {
        // $data['password'] = bcrypt($data['password']);
        // return $this->userRepository->create($data);
        // $dataArr = $this->repository->getByName($data['name']);
        // if(isset($dataArr[0])) {
        //     throw new ModelNotFoundException('User not found by ID ' . $user_id);
        //     return "A company with this name has already been created.";
        // }
        $path = $request->file('logo')->store('uploads','public');
        $data["logo"] = $path;
        return $this->repository->create($data);
    }

    public function update(array $data, int $id, object $request)
    {
        $path = $request->file('logo')->store('uploads','public');
        $data["logo"] = $path;
        $this->repository->update($data, $id);
    }
}