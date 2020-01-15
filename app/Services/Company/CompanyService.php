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
  public function __construct(CompanyRepository $companyRepository)
  {
    $this->repository = $companyRepository;
    $this->paginationRowsCount = 10;
  }
  public function create(array $data, object $request)
  {
    $path = $request->file('logo')->store('uploads','public');
    $data["logo"] = $path;
    return $this->repository->create($data);
  }

  public function update(array $data, int $id, object $request)
  {
        // getting image path from the request
    if ($request->logo) $data["logo"] = $request->file('logo')->store('uploads','public');
    $this->repository->update($data, $id);
  }
}