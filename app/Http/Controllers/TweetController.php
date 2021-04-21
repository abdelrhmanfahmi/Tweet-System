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

        return response()->json([], Response::HTTP_CREATED);
    }

    public function follow($id){
        $this->service->follow($id);
        return response()->json(['message' => 'Now You Can See His Updates'] , Response::HTTP_OK);
    }

    public function indexPdf(){
        $users = User::all();
        return view('welcome' , compact('users'));
    }

    public function createPDF(){
        $data = User::all();

        view()->share('users',$data);

        $pdf = PDF::loadView('pdf.report', $data);
  
        return $pdf->download('report.pdf');
    }
}
