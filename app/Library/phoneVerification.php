<?php

namespace App\Library;
use App\Contracts\Verification\Verificator;

class phoneVerification implements Verificator
{
	public function send_verification(string $contact_information){
		return 1;
	}
}