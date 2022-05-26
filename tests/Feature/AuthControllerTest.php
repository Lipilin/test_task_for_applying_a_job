<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Storage as Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Redirect;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\VerificationController;
use Mockery\MockInterface;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testLoginHasSuccess(){
        $data=[
            'username'=>'test2',
            'password'=>'password'
        ];
        $response=$this->call('POST','/login',$data)->assertRedirect('/');
    }

    public function testLoginHasFail(){
        $data=[
            'username'=>'sdafbabbfdh',
            'password'=>'asdafgga'
        ];
        $response=$this->call('POST','/login',$data)->assertRedirect('/login');;
    }
}
