<?php
namespace App\Services\Company;
use App\Services\AbstractInterface;
interface CompanyServiceInterface extends AbstractInterface
{
	public function create(array $data, object $request);

	public function update(array $data, int $id, object $request);
}