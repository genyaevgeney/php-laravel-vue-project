<?php
namespace App\Repositories\User;

use JWTAuth;
use App\Repositories\AbstractRepository;
use App\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function register(string $name, string $email, string $password)
    {
        $this->model->name = $name;
        $this->model->email = $email;
        $this->model->password = $password;
        $this->model->save();
        return $this->model;
    }

    public function login(array $data)
    {
        return JWTAuth::attempt($data);
    }

    public function logout(string $token)
    {
        return JWTAuth::invalidate($token);
    }
}
