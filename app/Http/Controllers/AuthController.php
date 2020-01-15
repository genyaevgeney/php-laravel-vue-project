<?php
namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationFormRequest;

class AuthController extends Controller
{
    public $loginAfterSignUp = true;
    protected $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

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
        return $this->respondWithToken($jwtToken);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout(Request $request)
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
      'access_token' => $token,
      'user' => $this->guard()->user(),
      'token_type' => 'bearer',
      'expires_in' => auth('api')->factory()->getTTL() * 60
    ]);
    }
    public function guard()
    {
        return \Auth::Guard('api');
    }
}
