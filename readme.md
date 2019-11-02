# Php Provably Fair

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

This library provides functions to generate and verify provably fair games.

## Installation

Via Composer

``` bash
composer require lpuddu/php-provably-fair
```

## Usage

### Create a new Generator
```php
$algorithm = 'sha256';
$generator = new Generator($algorithm);
```
If not provided, the `Generator` will use the **sha512/256** algorithm.

Get the full list of supported algorithms [here](https://www.php.net/manual/en/function.hash-hmac-algos.php).

### Security

If you discover any security related issues, please use the issue tracker on github or email me at info__at__lucapuddu.com

## Authors

- [Luca Puddu][link-author]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/lpuddu/php-provably-fair.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/lpuddu/php-provably-fair.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/lpuddu/php-provably-fair
[link-downloads]: https://packagist.org/packages/lpuddu/php-provably-fair
[link-travis]: https://travis-ci.org/lpuddu/php-provably-fair
[link-author]: https://github.com/LucaPuddu
