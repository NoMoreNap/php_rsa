<?php

require 'engine.php';

$RSA = new RSAClass(FILENAME);

$startTime = microtime(true);
$startMemory = memory_get_usage();


for ($i = 0; $i < 1e6; $i++) {
    $string = 'QWERTYUIOPASDFGHJKLZXCVBNM';
    $cryptedText = $RSA->encrypt($string, true);
    $decryptedText = $RSA->decrypt($cryptedText, true);

    if ($decryptedText != $string) {
        exit(0);
    }
}

for ($i = 0; $i < 1e6; $i++) {
    $string = 'QWERTYUIOPASDFGHJKLZXCVBNM';
    $cryptedText = $RSA->encrypt($string, false, true);
    $decryptedText = $RSA->decrypt($cryptedText, false, true);

    if ($decryptedText != $string) {
        exit(0);
    }
}

for ($i = 0; $i < 1e6; $i++) {
    $string = 'QWERTYUIOPASDFGHJKLZXCVBNM';
    $cryptedText = $RSA->encrypt($string, );
    $decryptedText = $RSA->decrypt($cryptedText);

    if ($decryptedText != $string) {
        exit(0);
    }
}


$endMemory = memory_get_usage();
$endTime = microtime(true);

$memoryUsed = $endMemory - $startMemory;
$timeUsed = $endTime - $startTime;

echo "Memory used: $memoryUsed bytes\n\nTime spent: $timeUsed";
