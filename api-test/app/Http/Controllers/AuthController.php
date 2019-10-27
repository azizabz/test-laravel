<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register;
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
}
