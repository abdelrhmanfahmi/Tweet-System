<?php

namespace App\Validation;

use App\Repositories\FollowingRepository;
use App\User;

class FollowingValidation {
    public function __construct(FollowingRepository $followRepo)
    {
        $this->repository = $followRepo;
    }
    
    public function checkUserExist($email)
    {
        $user = User::where('email' , '=' , $email)->first();
        if(!$user){
            abort(400 , 'User Not Found');
        }else{
            return $user;
        }
    }

    public function checkUser($followedUser)
    {
        if($followedUser->id == auth()->user()->id){
            abort(400 , 'You Can,t Follow Yourself');
        }
    }

    public function checkFollowHimSelf($followedUser)
    {
        if(app(FollowingRepository::class)->checkFollowing($followedUser->id)){

            abort(400 , 'You Already Following Him');

        }
    }
}