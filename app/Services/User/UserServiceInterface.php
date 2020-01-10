<?php
namespace App\Services\User;
use App\Services\AbstractInterface;
interface UserServiceInterface extends AbstractInterface
{
	public function register(object $data);
	public function login(array $data, $token);
	public function logout(string $token);
}