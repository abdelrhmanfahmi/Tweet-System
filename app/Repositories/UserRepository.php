<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function store($request): Model
    {
        return $this->model->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'dateOfBirth' => $request->get('dateOfBirth'),
            'image' => uploadNow('image' , $request),
        ]);
    }

}