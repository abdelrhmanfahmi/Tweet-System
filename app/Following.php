<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $table = "followings";
    protected $fillable = ['follow_from' , 'follow_to'];

    public function usersFollows(){
        return $this->belongsTo('App\User' , 'follow_from');
    }
}
