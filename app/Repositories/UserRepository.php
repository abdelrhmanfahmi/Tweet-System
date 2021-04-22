<?php

namespace App\Repositories;

use App\Tweet;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function all()
    {
        $users = $this->model->all();
        foreach($users as $user){
            $user->setAttribute('tweet_number' , count($user->tweets));
        }
        return $users;
    }

    public function store(array $attribute): Model
    {
        $user =  $this->model->create([
            'name' => $attribute['name'],
            'email' => $attribute['email'],
            'password' => Hash::make($attribute['password']),
            'date_of_birth' => $attribute['date_of_birth'],
            'image' => $attribute['image'],
        ]);
        
        return $user;
    }

    public function averageTweets()
    {
        $userCount = count($this->model->all());
        $tweetCount = Tweet::count();

        if($userCount > 0){
            $average = $tweetCount / $userCount;
            return $average;
        }else{
            return 0;
        }
    }

}