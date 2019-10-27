<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth\AuthInterface as AuthInterface;
use App\User;

class AuthController extends Controller
{
	private $authRepository;
 
    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
	}
	
    public function register(Request $request, User $user){
		$this->validate($request, [
    		'name'	=> 'required',
    		'email'	=> 'required|email|unique:users',
    		'password' => 'required|min:6'
		]);

		return $this->authRepository->createUser($request, $user);
		
	}
	
	public function login(Request $request, User $user){

		return $this->authRepository->loginUser($request, $user);

	}
}
