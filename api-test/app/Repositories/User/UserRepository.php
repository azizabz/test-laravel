<?php
namespace App\Repositories\User;

use Illuminate\Support\Facades\Auth;
use App\Repositories\User\UserInterface as UserInterface;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\UserTransformer;

use App\User;

class UserRepository implements UserInterface
{
    private $fractal;
    protected $user;

	public function __construct(Manager $fractal, UserTransformer $userTransformer, User $user)
	{
        $this->fractal = $fractal;
        $this->userTransformer = $userTransformer;
        $this->user = $user;
    }

    public function findById($id)
    {
        try {
            $user = User::findOrFail($id);
            $user = new Item($user, $this->userTransformer);
            $user = $this->fractal->createData($user);

            return $user->toArray();
                
        } catch (\Exception $e) {

            return response()->json(['message' => 'User not found!'], 404);
        }
    }

    public function getAllPagination($page)
    {
        $usersPaginator = User::paginate($page);
        // $users = User::all();
        $users = new Collection($usersPaginator->items(), $this->userTransformer);
        $users->setPaginator(new IlluminatePaginatorAdapter($usersPaginator));
        $users = $this->fractal->createData($users);

        return $users->toArray();
        
    }

    public function findProfile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }
}