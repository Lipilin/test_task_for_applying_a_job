<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\emailVerification;
use App\Library\phoneVerification;

class VerificationController extends Controller
{
	private $verificationClass;
    public function __construct(string $class_name){
    	$class_name='App\Library\\'.$class_name;
    	if(class_exists($class_name)){
    		return $this->verificationClass=new $class_name();
    	}
    	return $this->verificationClass=false;
    }

    public function makeVerification(string $contact_info){
    	if($this->verificationClass==false){
    		return false;
    	}
    	$answer = $this->verificationClass->send_verification($contact_info);
    	return $answer;
    }
}
