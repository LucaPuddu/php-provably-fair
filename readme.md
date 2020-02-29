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
#### Parameters values used in this example
```php
$algorithm = 'sha256';
$serverSeed = 'server seed';
$clientSeed = 'client seed';
$nonce = '1';
$min = 15;
$max = 96;
```

#### Steps
1. A hexadecimal string of variable length (depending on the algorithm used) is computed with [hash_hmac](https://www.php.net/manual/en/function.hash-hmac.php). The function 
uses the `$serverSeed` as key, and the `$clientSeed` and `$nonce` as data, concatenated with an _hyphen_:  
```php
$output1 = hash_hmac($algorithm, "{$clientSeed}-{$nonce}", $serverSeed);
echo $output1; // 78ed9330f00055f15765cb141088f316d507204a745ad4800fd719fcbfca071a
```

2. `$output1` is then scaled to a number from `0` to `1`, by converting it to an integer number and then
dividing it by the maximum result possible (which is equal to `16 ^ length of $output1`)
```php
$output2 = hexdec($output1) / (16 ** strlen($output1));
echo $output2; // 0.47237510628475
```  

3. `$output2` is scaled accordingly to `min` and `max`:  
```php
$result = $min + $output2 * ($max - $min);
echo $result; // 53.26238360906475‬
```

4. The **result** is returned.

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
