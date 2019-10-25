<?php

namespace App\Repositories\User;

interface UserInterface {
    public function findById($id);
    public function getAllPagination($page);
}