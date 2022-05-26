<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function change_logo(Request $request){
    	$data_validator = Validator::make($request->all(),[
    		'id'=>'required',
    		'logo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    	])->validate();
    	$path = $request->file('logo')->store('users_logo','public');
    	User::where('id',$request['id'])->where('is_admin',0)->update(['logo'=>$path]);
    	return redirect('/');
    }

    public function change_my_logo(Request $request){
    	$data_validator = Validator::make($request->all(),[
    		'logo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    	])->validate();
    	$path = $request->file('logo')->store('users_logo','public');
    	User::where('id',Auth::id())->update(['logo'=>$path]);
    	return redirect('/');
    }
}
