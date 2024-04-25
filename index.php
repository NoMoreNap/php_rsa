<?php
require_once 'engine.php';

$RSA = new RSAClass(FILENAME);

$params = Argv::get_launch_params($argv);

@list($is_passed, $error) = Argv::validate_launch_params($params);

if (!$is_passed) {
    exit($error);
}

$response = $RSA->
                {$params['method']}
                (
                    $params['message'],
                    $params['options']['base64'] ?? false,
                    $params['options']['hex'] ?? false
                );


var_dump($response);
