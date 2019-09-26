<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index($user_id = null)
	{
	   	if(isset($user_id))
	   	{
	   		$data = \DB::table('purchases')
	   			->where('user_id','=',$user_id)
	            ->orderBy('date', 'ASC')
	            ->get();
	   	}
	   	else
	   	{
		   	$data = \DB::table('purchases')
	            ->orderBy('date', 'ASC')
	            ->get();
	   	}
	   	return response()->json($data);
	}

	public function getUsers()
	{
		$users = \DB::table('users')
	                ->select('id','name')
	                ->get();
	    return response()->json($users);	
	}
}
