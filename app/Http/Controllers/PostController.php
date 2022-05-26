<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller
{
    public function create(Request $request){
    	$data_validation = Validator::make($request->all(),[
    		'title'=>'required',
    		'text'=>'required',
    		'visibility'=>'boolean',  		
    	])->validate();
    	$new_post=[
    		'title'=>$request['title'],
    		'text'=>$request['text'],  
    		'visibility'=>$request['visibility'],
    		'author'=>Auth::id(),
    	];
    	Post::create($new_post);
    	return redirect('/');
    }
    public function delete(Request $request){
    	if(Gate::allows('login-user-is-admin')){
    		Post::where('id',$request['id'])->delete();
            return redirect('/');
    	}
        Post::where('id',$request['id'])->where('author',Auth::id())->delete();
    	return redirect('/');
    }
    public function change_visibility(Request $request){
    	if(Gate::allows('login-user-is-admin')){
    		Post::where('id',$request['id'])->update(['visibility'=>!$request['visibility']]);
            return redirect('/');
    	}
        Post::where('id',$request['id'])->where('author',Auth::id())->update(['visibility'=>!$request['visibility']]);
    	return redirect('/');
    }
}
