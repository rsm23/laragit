<?php

namespace App\Traits;

use Input;
use ReCaptcha\ReCaptcha;

trait CaptchaTrait {
	/**
	 * reCaptcha Trait
	 *
	 * @return int
	 */
	public function captchaCheck() {
		$response = Input::get( 'g-recaptcha-response' );
		$remoteip = $_SERVER['REMOTE_ADDR'];
		$secret   = env( 'GOOGLE_RECAPTCHA_SECRET' );

		$recaptcha = new ReCaptcha( $secret );
		$resp      = $recaptcha->verify( $response, $remoteip );
		if ( $resp->isSuccess() ) {
			return 1;
		} else {
			return 0;
		}
	}
}
