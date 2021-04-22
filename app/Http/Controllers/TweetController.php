<?php

namespace App\Http\Controllers;

use App\Following;
use App\Http\Requests\TweetRequest;
use App\Services\TweetService;
use Illuminate\Http\Request;
use App\User;
use App\Tweet;
use Auth;
use Illuminate\Http\Response;
use PDF;

class TweetController extends Controller
{
    public $service;

    public function __construct(TweetService $tweetService)
    {
        $this->service = $tweetService;
    }
    
    public function createTweet(TweetRequest $request){

        $this->service->store($request->all());

        return response()->json(['message' => 'Tweet Created Successfully'], 200);
    }
}
