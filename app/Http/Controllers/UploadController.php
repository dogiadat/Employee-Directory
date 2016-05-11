<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UploadController extends Controller
{
    //
    public function uploader(){
    	return view('upload');
    }
    public function upload(Request $request){
    	$photo = $request->file('file');
    	$upload = 'img';
    	$filename = time().rand(0,1000).'.jpg';
    	$success = $photo->move($upload,$filename);
    	return 'uploaded';
    }
}
