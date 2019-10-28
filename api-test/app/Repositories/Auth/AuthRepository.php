<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

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
    		'password'	=> app('hash')->make($request->password),
    		'api_token'	=> app('hash')->make($request->email)
    	]);
 
    	$response = fractal()
    		->item($user)
    		->transformWith(new UserTransformer)
    		->toArray();
 
    	return response()->json($response, 201);
    }

    public function loginUser(Request $request, User $user)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
	}

	public function refreshToken()
    {
        return $this->respondWithToken(Auth::refresh());
    }
	
	/**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
	protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }
}
