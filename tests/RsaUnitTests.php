<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__.'/engine.php';



class RsaUnitTests extends TestCase {
    public function testCryptoEngine() {
        $strings = [
            'abc',
            '123',
            'tony'
        ];

        $RSA = new RSAClass(FILENAME);

        foreach ($strings as $string) {
            $cryptedText = $RSA->encrypt($string);
            $decryptedText = $RSA->decrypt($cryptedText);
            $this->assertEquals($string, $decryptedText);
        }
    }

    public function testBase64Crypto() {

        $strings = [
            'abc' => 'h0NAf7LGbSbKrzpT97k0ZivwQ0PcWLxhYy9Ye1SMJuA8X4xCYmvgTBOFcwJdXWDo3xzm8rKYz2YqvGe2kF0XWA==',
            '123' => '3fMPO0ixKyGSNEXezY9SqQqb+kMQkqNFHWog3eA8QX8vJ3/dC4NVeRnKNlWSmAcvC5c6Yp6Q+5NDYRGoMq6aXg==',
            'tony' => 'jPgV7+/RqDue9RQoolPoX+BYPJ0ku9taMjeoVhGz7IhQ7wRy9kgCXZxqSayLB1gFa/c3ZR8z03de1jnTCEU4Ww=='
        ];

        $RSA = new RSAClass(FILENAME);

        foreach ($strings as $key => $value) {
            $cryptedText = $RSA->encrypt($key, true);

            $this->assertEquals($value, $cryptedText);

            $decryptedText = $RSA->decrypt($cryptedText, true);
            $this->assertEquals($key, $decryptedText);
            break;

        }

    }

    public function testHexCrypto() {
        $strings = [
            'abc' => '8743407fb2c66d26caaf3a53f7b934662bf04343dc58bc61632f587b548c26e03c5f8c42626be04c138573025d5d60e8df1ce6f2b298cf662abc67b6905d1758',
            '123' => 'ddf30f3b48b12b21923445decd8f52a90a9bfa431092a3451d6a20dde03c417f2f277fdd0b83557919ca36559298072f0b973a629e90fb93436111a832ae9a5e',
            'tony' => '8cf815efefd1a83b9ef51428a253e85fe0583c9d24bbdb5a3237a85611b3ec8850ef0472f648025d9c6a49ac8b0758056bf737651f33d3775ed639d30845385b'
        ];

        $RSA = new RSAClass(FILENAME);

        foreach ($strings as $key => $value) {
            $cryptedText = $RSA->encrypt($key, false, true);

            $this->assertEquals($value, $cryptedText);

            $decryptedText = $RSA->decrypt($cryptedText, false, true);
            $this->assertEquals($key, $decryptedText);

        }

    }



}

