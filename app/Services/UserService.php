<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class UserService extends BaseService
{
    public function __construct(UserRepository $userRepo){
        $this->repository = $userRepo;
    }

    public function store($data)
    {
        return $this->repository->store($data);
    }
}