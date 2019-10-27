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

        //validate incoming request 
        // $this->validate($request, [
        //     'email' => 'required|string',
        //     'password' => 'required|string',
        // ]);

        // $credentials = $request->only(['email', 'password']);

        // if (! $token = Auth::attempt($credentials)) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        // return $this->respondWithToken($token);
    
    }
}
