<?php
require 'keys.php';

class RSAClass {
    private false | OpenSSLAsymmetricKey $private_key, $public_key;

    function __construct(string $filename)
    {
        $this->private_key = openssl_pkey_get_private(file_get_contents(__DIR__."/$filename"));
        $this->public_key = openssl_pkey_get_public(file_get_contents(__DIR__."/$filename".".pem"));
    }

    public function encrypt(string $message,  bool $is_base_64 = false, bool $is_hex = false) {
        openssl_private_encrypt($message, $encrypted, $this->private_key);

        if ($is_base_64) {
            return base64_encode($encrypted);
        } else if ($is_hex) {
            return bin2hex($encrypted);
        } else return $encrypted;

    }

    public function decrypt(string $message,  bool $is_base_64 = false, bool $is_hex = false) {
        if ($is_base_64) {
            $message = base64_decode($message);
        }
        if ($is_hex) {
            $message = hex2bin($message);
        }
        openssl_public_decrypt($message, $decrypted, $this->public_key);

        return $decrypted;
    }
}



