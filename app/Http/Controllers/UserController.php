<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Storage;
use PDF;

class UserController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 5;
    protected $decayMinutes = 30;
    public $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request){
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return response()->json(['message' => 'You Entered Email Or Password Incoorect 5 Times ,Please Wait 30 minutes And Try Again'], 400);
        }

        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                $this->incrementLoginAttempts($request);
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $this->clearLoginAttempts($request);
        return response()->json(compact('token'));
    }

    public function signup(SignUpRequest $request){
        $token = $this->service->store($request->all());
        return response()->json(compact('token'),201);
    }

    public function showInfoReport(){
        $user = $this->service->getUsers();
        $average = $this->service->getAverage();
        return response()->json(['users' => $user , 'averageTweets' => $average]);
    }

    public function downloadPdf(){
        $data = $this->service->getUsers();

        view()->share('users',$data);

        $pdf = PDF::loadView('pdf.report', $data);

        return $pdf->download('report.pdf');

        // Storage::put('public/pdf/invoice.pdf', $pdf->output());

        // return response()->download('public/pdf/invoice.pdf');
    }
}
