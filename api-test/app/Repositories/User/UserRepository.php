<?php
namespace App\Repositories\User;

use App\Repositories\User\UserInterface as UserInterface;
use App\Transformers\UserTransformer;

use App\User;

class UserRepository implements UserInterface{

    protected $user;

	public function __construct(User $user)
	{
        $this->user = $user;
    }

    public function findById($id)
    {
        $user = User::find($id);
        return fractal()
    		->collection($user)
    		->transformWith(new UserTransformer)
    		->toArray();
    }

    public function getAllPagination($page)
    {
        $users = User::paginate($page);
        return fractal()
    		->collection($users)
    		->transformWith(new UserTransformer)
    		->toArray();
        
    }

    public function findProfile()
    {
        return response()->json(['user' => Auth::user()], 201);
    }
}