<?php

namespace App\Services;

use App\Following;
use App\Repositories\FollowingRepository;
use App\Repositories\TweetRepository;
use App\Repositories\UserRepository;
use App\User;

class TweetService extends BaseService
{
    public function __construct(TweetRepository $tweetRepo)
    {
        $this->repository = $tweetRepo;
    }

    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;
        $this->repository->store($data);
    }

    public function follow($id){
        $followedUser = User::findorFail($id);
        
        $this->checkUser($followedUser);

        if(app(FollowingRepository::class)->checkFollowing($id)){

            abort(400 , 'You Already Following Him');

        }else{
            $data['follow_from'] = auth()->user()->id;
            $data['follow_to'] = $id;
            app(FollowingRepository::class)->store($data);
        }
    }

    private function checkUser($followedUser){
        if($followedUser->id == auth()->user()->id){
            abort(400 , 'You Can,t Follow Yourself');
        }
    }

    public function getUsers(){
        return app(UserRepository::class)->all();
    }
}