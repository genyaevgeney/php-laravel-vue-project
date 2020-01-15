<?php
namespace App\Repositories\Company;

use App\Repositories\AbstractRepository;
use App\Models\Company;

class CompanyRepository extends AbstractRepository implements CompanyRepositoryInterface
{
    public function __construct(Company $company)
    {
        $this->model = $company;
    }
}
