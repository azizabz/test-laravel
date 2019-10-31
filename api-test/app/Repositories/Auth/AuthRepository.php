<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth\AuthInterface as AuthInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\UserTransformer;

use App\User;

class AuthRepository implements AuthInterface
{
    private $fractal;
    protected $user;

    public function __construct(Manager $fractal, UserTransformer $userTransformer, User $user)
    {
        $this->fractal = $fractal;
        $this->userTransformer = $userTransformer;
        $this->user =  $user;
    }

    public function createUser(Request $request)
    {

        $user = User::create([
            'name'    => $request->name,
            'email'    => $request->email,
            'password'    => app('hash')->make($request->password)
        ]);

        $user = new Item($user, $this->userTransformer);

        return $user;
    }

    public function loginUser(Request $request, User $user)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
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
