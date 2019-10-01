<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Purchase;

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

	public function getSellers()
	{
		$sellers = \DB::table('sellers')
	                ->select('id','name')
	                ->get();
	    return response()->json($sellers);	
	}

	public function addPurchase(Request $request)
	{
		/*$this->validate($request, [
        
        ]);*/
        
		\DB::table('purchases')->insert(['user_id' => $request->user, 
										'seller_id' => $request->seller, 
										'date' => $request->date, 
										'description' => $request->description, 
										'share' => $request->share,
										'amount' => $request->amount] );


        return response()->json(null, 200);
	}
}
