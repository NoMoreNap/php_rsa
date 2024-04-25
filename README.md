# PHP RSA 512

# `start`

- choose keys filename in keys.php
- run
```shell
php init.keys.php
```

# `usage`

## from command line

```shell
php .\index.php [-options] [(message|file)=string]
```

### options
```textmate
!one of the block!

-----REQUIRED-------
-c -- encrypt string
-d -- decrypt string
--------------------

-b -- base64 output or input string
-h -- hex output or input string
without this option binary output or input string


----------REQUIRED-----------
message=text -- ur input text
file=path_to_file.txt ur input file with text
```


## by code

```php
require 'keys.php';

$RSA = new RSAClass(FILENAME);

$is_base64 = true;
$is_hex = true;
$key = 'tony'
/* base64 or hex or nothing */
$cryptedText = $RSA->encrypt($key, $is_base64, $is_hex); 
/*
 if base64 to be 
    jPgV7+/RqDue9RQoolPoX+BYPJ0ku9taMjeoVhGz7IhQ7wRy9kgCXZxqSayLB1gFa/c3ZR8z03de1jnTCEU4Ww==
 if hex to be
    8cf815efefd1a83b9ef51428a253e85fe0583c9d24bbdb5a3237a85611b3ec8850ef0472f648025d9c6a49ac8b0758056bf737651f33d3775ed639d30845385b
 if nothing to be a binary sequence
 */

/* it should be the same option as in encrypt method otherwise u get error*/
$decryptedText = $RSA->decrypt($cryptedText, $is_base64, $is_hex);

```

## tests
OK (3 tests, 11 assertions)
## benckmark
Memory used: 152 bytes

Time spent: 103.59488296509

