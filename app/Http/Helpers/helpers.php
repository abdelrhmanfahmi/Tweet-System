<?php
use App\Tweet;
use App\User;

function uploadNow($imgName, $request, $multi = false, $exts = [], $file_upload = ''){  
	$namefile = uniqid();
	$file = ($multi) ? $request : $request->file($imgName);
	$ext = strtolower($file->getClientOriginalExtension());
	$exts = empty($exts) ? ['jpeg','jpg','png'] : $exts;
    if(!in_array($ext, $exts)){
		return '';
    }
	$fullname = $namefile.'.'.$ext;
	$file_upload = ($file_upload == '') ? 'uploads' : $file_upload;
	$file->move(public_path($file_upload),$fullname);
	return $fullname;
}

function countTweetForUser($id){
	$count = Tweet::where('user_id' , '=' , $id)->count();
	return $count;
}

function averageOfTweetsPerUser(){
	$countTweet = Tweet::count();
	$countUsers = User::count();

	$average = $countTweet / $countUsers;
	return $average;
}