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

            return $user;
        } catch (\Exception $e) {
            throw new \App\Exceptions\BaseException('User not found!');
        }
    }

    public function getAllPagination($page)
    {
        $usersPaginator = User::paginate($page);
        $users = new Collection($usersPaginator->items(), $this->userTransformer);
        $users->setPaginator(new IlluminatePaginatorAdapter($usersPaginator));

        return $users;
    }

    public function findProfile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }
}
