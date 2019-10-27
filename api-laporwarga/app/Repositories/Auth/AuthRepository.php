<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Repositories\Auth\AuthInterface as AuthInterface;
use App\Transformers\UserTransformer;

use App\User;

class AuthRepository implements AuthInterface
{
    protected $user;

	public function __construct(User $user)
	{
        $this->user =  $user;
    }

    public function createUser(Request $request, User $user){
    	
    	$user = User::create([
    		'name'	=> $request->name,
    		'email'	=> $request->email,
    		'password'	=> Crypt::encrypt($request->password),
    		'api_token'	=> Crypt::encrypt($request->email)
    	]);
 
    	$response = fractal()
    		->item($user)
    		->transformWith(new UserTransformer)
    		->toArray();
 
    	return response()->json($response, 201);
    }
}
