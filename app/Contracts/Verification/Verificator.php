<?php
namespace App\Contracts\Verification;

interface Verificator
{
	public function send_verification(string $contact_information);
}
