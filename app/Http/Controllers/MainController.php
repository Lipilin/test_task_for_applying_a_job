<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function mainpage(Request $request){
    	$background=isset($request['background'])?$request['background']:'';
    	$depth=isset($request['depth']) && $request['depth']!=0 || $request['depth']=='max'?$request['depth']:1;
    	setcookie('depth',$depth);
    	return view('main',compact(array('background')));
    }
}
