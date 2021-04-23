<?php

namespace App\Services;

use App\Repositories\TweetRepository;

class TweetService extends BaseService
{
    public function __construct(TweetRepository $tweetRepo)
    {
        $this->repository = $tweetRepo;
    }

    public function store($data)
    {
        $this->repository->store($data);
    }
}