<?php

namespace App\Services;

use App\Repositories\FollowingRepository;
use App\User;
use App\Validation\FollowingValidation;

class FollowingService extends BaseService
{
    public function __construct(FollowingRepository $followRepo , FollowingValidation $followValid)
    {
        $this->repository = $followRepo;
        $this->validate = $followValid;
    }

    public function follow($email){
        $followedUser = $this->validate->checkUserExist($email);
        
        $this->validate->checkUser($followedUser);

        $this->validate->checkFollowHimSelf($followedUser);

        $data['follow_from'] = auth()->user()->id;
        $data['follow_to'] = $followedUser->id;
        app(FollowingRepository::class)->store($data);
    }
}