<?php
namespace App\Services;
interface AbstractInterface
{
	public function delete(int $id);

	public function paginate();
}