<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\VerificationController;
use App\Library\emailVerification;
use App\Library\phoneVerification;
class VerificationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMakeVerificationHasSuccessIfTypeEmail(){
        $verification=new VerificationController('emailVerification');
        $this->createStub(emailVerification::class);
        $result = $verification->makeVerification('email@email.com');
        $this->assertNotEquals(false,$result);
    }
    public function testMakeVerificationHasFailIfTypeEmail(){
        $verification=new VerificationController('emailVerification');
        $this->createStub(emailVerification::class);
        $result = $verification->makeVerification('123');
        $this->assertEquals(false,$result);
    }
    public function testMakeVerificationIfTypePhone(){
        $verification=new VerificationController('phoneVerification');
        $this->createStub(phoneVerification::class);
        $result = $verification->makeVerification('123');
        $this->assertNotEquals(false,$result);
    }
    public function testMakeVerificationHasFailBecauseClassIsInvalid(){
        $verification=new VerificationController('adfafhn');
        $result = $verification->makeVerification('123');
        $this->assertEquals(false,$result);
    }
}
