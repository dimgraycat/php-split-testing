[![License](https://img.shields.io/badge/license-mit-blue.svg?style=flat-square)](https://github.com/dimgraycat/php-split-testing/blob/master/LICENSE)
[![Latest Stable Version](https://img.shields.io/packagist/v/dimgraycat/phpirkit.svg?style=flat-square)](https://packagist.org/packages/dimgraycat/split-testing)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.3-8892BF.svg?style=flat-square)](https://php.net/)
[![Travis](https://img.shields.io/travis/rust-lang/rust.svg?style=flat-square)](https://travis-ci.org/dimgraycat/php-split-testing)
[![Tests](https://php-eye.com/badge/dimgraycat/split-testing/tested.svg?style=flat-square)](https://php-eye.com/package/dimgraycat/split-testing)

# SplitTesting
A server-side A/B/n testing tool

This library provides a layer to run AB tests on your applications.
The "SplitTesting" is useful when you want to change something on the application, but you want to check the optimize by using various variations.

## Installation

```bash
$ composer require dimgraycat/split-testing
```
```json
{
    "require": {
        "dimgraycat/split-testing": "1.0.*"
    }
}
```

And install dependencies:

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

## Usage

### Random
```php
<?php
use Ab\SplitTesting;

$params = array(
	'use'		=> 'random',
    'variation' => array(
        'foo',
        'bar',
        'baz'
    );
);

$result = SplitTesting::get($params);

// $seed is optional
// e.g.) userId, IpAddress
$seed = 1234;
echo SplitTesting::get($params, $seed);
```

### Rate (Roulette)
```php
<?php
use Ab\SplitTesting;

$params = array(
	'use'       => 'rate',
	'variation' => array(
		'rate'  => array(
          	// 1 => 0.1%, 50 => 5%, 500 => 50%, 1000 => 100%
			'foo' => 50,
			'bar' => 20,
			'baz' => 500,
		),
		'list'  => array(
			'default'   => array('hoge'),
			'a'         => '5%',
			'hoge'      => 1234567890,
			'moge'      => '123456789',
		),
	),
);
echo SplitTesting::get($params);
```

### PatternMatch
```php
<?php
use Ab\SplitTesting;

$params = array(
	'use'       => 'pattern',
	'variation' => array(
		'pattern'   => array(
			'foo' => '/[0-9]$/',
			'bar' => '/z$/',
		),
		'list'      => array(
			'default'	=> 'default',
			'foo'       => 'hit 1!',
			'bar'       => 'hit 2!'
		),
	),
);

$seed = 1234; // required
echo SplitTesting::get($params, $seed); // hit 1!
```
