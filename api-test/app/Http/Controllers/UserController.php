<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserInterface as UserInterface;

class UserController extends Controller
{
    private $userRepository;

    /** 
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->middleware('auth');

        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAllPagination(2);

        return $this->responseSuccess($users);
    }

    public function find($id)
    {
        $user = $this->userRepository->findById($id);

        return $this->responseSuccess($user);
    }

    public function profile()
    {
        return $this->userRepository->findProfile();
    }
}
