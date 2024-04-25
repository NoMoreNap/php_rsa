<?php
require 'keys.php';

class RSAClass {
    private false | OpenSSLAsymmetricKey $private_key, $public_key;

    function __construct(string $filename)
    {
        $this->private_key = openssl_pkey_get_private(file_get_contents($filename));
        $this->public_key = openssl_pkey_get_public(file_get_contents($filename.".pem"));
    }

    public function encrypt(string $message,  bool $is_base_64 = false, bool $is_hex = false): string {
        openssl_private_encrypt($message, $encrypted, $this->private_key);

        if ($is_base_64) {
            return base64_encode($encrypted);
        } else if ($is_hex) {
            return bin2hex($encrypted);
        } else return $encrypted;

    }

    public function decrypt(string $message,  bool $is_base_64 = false, bool $is_hex = false): string {
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


class Argv  {
    static function get_launch_params(array $argv) {
        $method = ['-c' => 'encrypt',  '-d' => 'decrypt'];
        $options = ['-b' => 'base64', '-h' => 'hex'];
        $response = [];

        foreach ($argv as $arg) {

            if (in_array($arg, array_keys($method))) {
                $response['method'] = $method[$arg];
            }

            if (in_array($arg, array_keys($options))) {
                $response['options'][$options[$arg]] = true;
            }

            if (strpos($arg, '=')) {
                list($key, $value) = explode('=', $arg);
                switch ($key) {
                    case 'message':
                        $response['message'] = $value;
                        break;
                    case 'file':
                        $message = file_get_contents($value);
                        $response['message'] = $message;
                        break;
                }
            }
        }

        return $response;

    }


    static function validate_launch_params(array $params) {
        if (!isset($params['method'])) {
            return [false, 'Не передан метод'];
        }
        if (!isset($params['message'])) {
            return [false, 'Не передано сообщение'];
        }

        return [true];

    }
}


