# Php Provably Fair

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

This library provides functions to generate and verify provably fair games.

## Installation

Via Composer

``` bash
composer require lucapuddu/php-provably-fair
```

## The algorithm
#### Example parameters
```php
$algorithm = 'sha256';
$serverSeed = 'server seed';
$clientSeed = 'client seed';
$nonce = '1';
$min = 0;
$max = 100;
```

#### Steps
1. A 64-long hexadecimal string is computed using [hash_hmac](https://www.php.net/manual/en/function.hash-hmac.php). The function 
uses the `$serverSeed` as key, and the `$clientSeed` and `$nonce` as data, concatenated with an _hyphen_, like this:  
`hash_hmac($algorithm, "{$clientSeed}-{$nonce}", $serverSeed);`  
**Output**: `78ed9330f00055f15765cb141088f316d507204a745ad4800fd719fcbfca071a`

2. The characters from position _7 to 12_ are extracted from the hash and converted to integer using [hexdec](https://www.php.net/manual/en/function.hexdec.php).  
|                  |                               Value                                  |
| ---------------- | -------------------------------------------------------------------- |
|   Original hash  | 78ed93**30f000**55f15765cb141088f316d507204a745ad4800fd719fcbfca071a |
| Extracted string |                              30f000                                  |
|      To int      |                             3207168                                  |

3. 

## Usage

### Create a `ProvablyFair` Object
```
$algorithm = 'sha256';
$serverSeed = 'server seed';
$clientSeed = 'client seed';
$nonce = 'nonce';
$min = 23.75;
$max = 44;
$generator = Builder::make()
                    ->algorithm($algorithm)
                    ->serverSeed($serverSeed)
                    ->clientSeed($clientSeed)
                    ->nonce($nonce)
                    ->min($min)
                    ->max($max)
                    ->build();
```
##### Default values
```
$algorithm = 'sha512/256';
$min = 0;
$max = 100;
```

Get the full list of supported algorithms [here](https://www.php.net/manual/en/function.hash-hmac-algos.php).

### Roll a number
```php
...
$output = $generator->roll();
echo $output;   //38.325308655221

// Change ProvablyFair state
$generator->setNonce('new nonce');

// Roll a new number
$output = $generator->roll();
echo $output;   //23.752100169784
```

### Verify a roll
```
...
$generator->verify(38.325308655221); // true
```

### Security

If you discover any security related issues, please use the issue tracker on github or email me at info__at__lucapuddu.com

## Authors

- [Luca Puddu][link-author]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/lucapuddu/php-provably-fair.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/lucapuddu/php-provably-fair.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/lucapuddu/php-provably-fair
[link-downloads]: https://packagist.org/packages/lucapuddu/php-provably-fair
[link-author]: https://github.com/LucaPuddu
