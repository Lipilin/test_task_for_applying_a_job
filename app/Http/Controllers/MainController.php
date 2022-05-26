<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function mainpage(Request $request){
    	if(Gate::allows('login-user')){
    		$posts=Post::all();
    		$current_user=Auth::user();
    	}else{
    		$posts=Post::where('visibility',1)->get();
    		$current_user=[];
    	}
    	$users=Gate::allows('login-user-is-admin')?User::where('is_admin',0)->get():[];
    	return view('main',compact(array('posts','users','current_user')));
    }
    public function registration(){
    	return view('registration');
    }
    public function login(){
    	return view('login');
    }
}
