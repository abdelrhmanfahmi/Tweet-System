<?php

namespace App\Repositories;

use App\Following;
use Illuminate\Database\Eloquent\Model;

class FollowingRepository extends BaseRepository
{
    public function __construct(Following $follow)
    {
        parent::__construct($follow);
    }

    public function checkFollowing($id)
    {
        return $this->model->where('follow_to' , '=' , $id)->first();
    }
}