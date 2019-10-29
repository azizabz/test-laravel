<?php

namespace App\Repositories\Auth;

use Illuminate\Http\Request;

use App\User;

interface AuthInterface {
    public function createUser(Request $request);
    public function loginUser(Request $request, User $user);
    public function refreshToken();
}