<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Register;
use App\Http\Requests\Login;
use Illuminate\Http\Request;
use App\Repositories\Auth\AuthInterface as AuthInterface;

use  App\User;

class AuthController extends Controller
{
    private $authRepository;
 
    public function __construct(AuthInterface $authRepository)
    {
        $this->middleware('auth', ['except' => ['register', 'login']]);
        $this->authRepository = $authRepository;
    }
    
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Register $request, User $user)
    {

		return $this->authRepository->createUser($request, $user);
    
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Login $request, User $user)
    {

        return $this->authRepository->loginUser($request, $user);
        
    }
    
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->authRepository->refreshToken();
    }
}
