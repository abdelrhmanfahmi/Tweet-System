<?php

namespace App\Services;

use App\Repositories\TweetRepository;
use App\Repositories\UserRepository;

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
}