<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Http\Requests\RegistrationFormRequest;
class APIController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;
    protected $service;

    public function __construct(UserService $userService)
    {
    	$this->service = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
    	$input = $request->only('email', 'password');
    	$token = null;
    	$jwtToken = $this->service->login($input, $token);

    	if (!$jwtToken) {
    		return response()->json([
    			'success' => false,
    			'message' => 'Invalid Email or Password',
    		], 401);
    	}

    	return response()->json([
    		'success' => true,
    		'token' => $jwtToken,
    	]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function logout(Request $request)
    {
    	$this->validate($request, [
    		'token' => 'required'
    	]);
    	$token = $request->token;
    	$responseData = $this->service->logout($token);
    	if($responseData['success']) {
    		return response()->json($responseData);
    	}
    	
    	return response()->json($responseData, 500);
    }

    /**
     * @param RegistrationFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegistrationFormRequest $request)
    {

    	$user = $this->service->register($request);

    	if ($this->loginAfterSignUp) {
    		return $this->login($request);
    	}

    	return response()->json([
    		'success'   =>  true,
    		'data'      =>  $user
    	], 200);
    }
}
