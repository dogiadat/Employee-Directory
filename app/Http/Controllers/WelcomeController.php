<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WelcomeController extends Controller
{
    //
    public function about(){
    	$about = "Ngô Thị Khánh Ly";
    	return view('about')->with('ly',$about);
    }
}
