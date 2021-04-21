<?php

namespace App\Repositories;

use App\Tweet;
use Illuminate\Database\Eloquent\Model;

class TweetRepository extends BaseRepository
{
    public function __construct(Tweet $tweet)
    {
        parent::__construct($tweet);
    }
}