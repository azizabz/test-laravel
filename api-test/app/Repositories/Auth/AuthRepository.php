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

            // $user = new User;
            // $user->name = $request->input('name');
            // $user->email = $request->input('email');
            // $plainPassword = $request->input('password');
			// $user->password = app('hash')->make($plainPassword);
			// $user->api_token = app('hash')->make($user->email);

            // $user->save();

            // //return successful response
            // return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        
    	
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
        if (!Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
    		return response()->json(['error'=>'Wrong Credentials'], 401);
    	}
		$user = $user->find(Auth::user()->id);
		
		return fractal()
    		->item($user)
			->transformWith(new UserTransformer)
			->addMeta([
				'token'=>$user->api_token
			])
    		->toArray();
    }
}
