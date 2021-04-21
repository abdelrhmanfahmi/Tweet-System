<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $table="tweets";
    protected $fillable = ['content' , 'user_id'];

    public function users(){
        return $this->belongsTo('App\User' , 'user_id');
    }
}
