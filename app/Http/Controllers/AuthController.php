<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Redirect;


class AuthController extends Controller
{
    public function registration(Request $request){
    	$data_validation = Validator::make($request->all(),[
    		'username'=>'required|min:4|max:16|unique:users',
    		'password'=>'required|min:4|max:16',
    		'logo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    		'contact_info'=>'required',
    		'verificationType'=>'required'
    	])->validate();
    	$verification=new VerificationController($request['verificationType']);
    	$verification=$verification->makeVerification($request['contact_info']);
    	if($verification==false){
    		return redirect('/registration');
    	};
    	$path = $request->file('logo')->store('users_logo','public');
    	$credentials=array(
    		'username'=>$request['username'],
    		'password'=>bcrypt($request['password']),
    		'logo'=>$path,
    		'contact_info'=>$request['contact_info'],
    		'confirmUrl'=>$verification,
    	);
    	User::create($credentials);
    	return redirect('/login');
    }

    public function login(Request $request){
    	$data_validation = Validator::make($request->all(),[
    		'username'=>'required|min:4|max:16',
    		'password'=>'required|min:4|max:16',
    	])->validate();
    	$credentials=array(
    		'username'=>$request['username'],
    		'password'=>$request['password'],
    		'confirmUrl'=>1,
    	);
    	if(Auth::attempt($credentials)){
    		Gate::authorize('login-user');
    		Gate::allows('login-user-is-admin');	
    		return redirect('/');
    	}
    	return redirect('/login');
    }

    public function checkVerification(Request $request){
        User::where('contact_info',$request['email'])->where('confirmUrl',$request['token'])->update(['confirmUrl'=>1]);
        return redirect('/');
    }

    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }
}
