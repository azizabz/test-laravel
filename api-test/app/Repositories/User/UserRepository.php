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
        return User::find($id);
    }
    public function getAllPagination($page)
    {
        $users = User::paginate($page);
        return fractal()
    		->collection($users)
    		->transformWith(new UserTransformer)
    		->toArray();
        
    }
}