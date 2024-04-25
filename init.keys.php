<?php

require 'keys.php';

$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 512,
    "private_key_type" => OPENSSL_KEYTYPE_RSA
);
$key = openssl_pkey_new($config);

$key_details = openssl_pkey_get_details($key);

openssl_pkey_export($key, $private_key);

$public_key = $key_details['key'];

file_put_contents(FILENAME.'.pem', $public_key);
file_put_contents(FILENAME, $private_key);



