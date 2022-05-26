<?php

namespace App\Library;
use App\Contracts\Verification\Verificator;
use App\Jobs\EmailVerificationJob;
use Mail;
class emailVerification implements Verificator
{
	public function send_verification(string $contact_information){
		if(!filter_var($contact_information, FILTER_VALIDATE_EMAIL)){
			return false;
		}
		$randomToken=rand(10000,99999);
		$confirmUrl=env('APP_URL').":8000/confirm_email?email=$contact_information&token=$randomToken";
        $data=[
            'url'=>$confirmUrl,
        ];
        dispatch(new EmailVerificationJob($contact_information,$confirmUrl));
		return $randomToken;
	}
}
