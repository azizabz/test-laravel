<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\UserInterface as UserInterface;

class UserController extends Controller
{
    private $userRepository;
 
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return $user = $this->userRepository->getAllPagination(2);
    }

    public function find($id)
    {
        return $user = $this->userRepository->findById($id);
    }
}
