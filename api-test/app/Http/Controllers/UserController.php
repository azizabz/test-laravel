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
        return $this->userRepository->getAllPagination(2);
    }

    public function find($id)
    {
        return $this->userRepository->findById($id);
    }

    public function profile()
    {
        return $this->userRepository->findProfile();
    }
}
