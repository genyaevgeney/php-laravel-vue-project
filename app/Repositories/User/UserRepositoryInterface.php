<?php
namespace App\Repositories\User;

use App\Repositories\AbstractInterface;

interface UserRepositoryInterface extends AbstractInterface
{
    public function register(string $name, string $email, string $password);
    public function login(array $data);
    public function logout(string $token);
}
