<?php

namespace App\Services\User;

use App\Repositories\Company\CompanyRepository;
use App\Repositories\User\UserRepository;
use App\Services\AbstractService;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserService extends AbstractService implements UserServiceInterface {
	/**
	 * CompanyService constructor.
	 * @param CompanyRepository $companyRepository
	 */
	public function __construct(UserRepository $userRepository) {
		$this->repository = $userRepository;
	}
	/**
	 * Create a new user instance.
	 * @param array $data
	 * @return mixed
	 */
	public function register(object $data) {
		$userName = $data->name;
		$userEmail = $data->email;
		$userPassword = bcrypt($data->password);
		return $this->repository->register($userName, $userEmail, $userPassword);
	}

	public function login(array $data, $token) {
		$token = $this->repository->login($data);
		return $token;
	}

	public function logout(string $token) {
		try {
			$this->repository->logout($token);

			return [
				'success' => true,
				'message' => 'User logged out successfully',
			];
		} catch (JWTException $exception) {
			return [
				'success' => false,
				'message' => 'Sorry, the user cannot be logged out',
			];
		}
	}
}
