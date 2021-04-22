<?php

namespace App\Services;

use App\Repositories\UserRepository;
use JWTAuth;
use Illuminate\Http\Request;

class UserService extends BaseService
{
    public function __construct(UserRepository $userRepo)
    {
        $this->repository = $userRepo;
    }

    public function store($data)
    {
        $data['image'] = $this->uploadImage($data['image']);
        $user = $this->repository->store($data);
        $token = JWTAuth::fromUser($user);
        return $token;
    }

    private function uploadImage($file)
    {
        $path = $file->store('images' , 'public');
        return $path;
    }

    public function getUsers()
    {
        return $this->repository->all();
    }

    public function getAverage()
    {
        return app(UserRepository::class)->averageTweets();
    }
}