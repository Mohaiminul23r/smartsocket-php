<?php
final class SDLCrypt{
	static private function checkCryptKey($secretKey){
		if(strlen($secretKey) != 32) throw new Exception('"SecretKey length is not 32 chars"'); //Logic can be changed to be 32 bytes unconditionally (must be agreed between two models)
		$iv = substr($secretKey, 0, 16); //IV In order to agree between two models, this rule needs to be set. 
		return [$secretKey, $iv];
	}
	static function encrypt($v, $secretKey){
		$k = self::checkCryptKey($secretKey);
		return openssl_encrypt($v, 'aes-256-cbc', $k[0], 0, $k[1]);
	}
	static function decrypt($v, $secretKey){
		$k = self::checkCryptKey($secretKey);		
		return openssl_decrypt($v, 'aes-256-cbc', $k[0], 0, $k[1]);
	}
	
}