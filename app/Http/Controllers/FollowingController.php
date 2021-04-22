<?php

namespace App\Http\Controllers;

use App\Services\FollowingService;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    public function __construct(FollowingService $followService)
    {
        $this->service = $followService;
    }

    public function followUser($email){
        $this->service->follow($email);
        return response()->json(['message' => 'Now You Can See His Updates'] , 200);
    }
}
