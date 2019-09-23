<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
	{
	   $coins = \DB::table('purchases')
	                ->orderBy('date', 'ASC')
	                ->get();
	    return response()->json($coins);
	}
}
