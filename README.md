# CakePHP Adapter

[![Latest Version](https://img.shields.io/github/release/php-http/cakephp-adapter.svg?style=flat-square)](https://github.com/php-http/cakephp-adapter/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![CI](https://github.com/php-http/cakephp-adapter/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/php-http/cakephp-adapter/actions/workflows/ci.yml)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/php-http/cakephp-adapter.svg?style=flat-square)](https://scrutinizer-ci.com/g/php-http/cakephp-adapter)
[![Quality Score](https://img.shields.io/scrutinizer/g/php-http/cakephp-adapter.svg?style=flat-square)](https://scrutinizer-ci.com/g/php-http/cakephp-adapter)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.1-8892BF.svg)](https://php.net/)
[![Total Downloads](https://img.shields.io/packagist/dt/php-http/cakephp-adapter.svg?style=flat-square)](https://packagist.org/packages/php-http/cakephp-adapter)

[HTTPlug](http://httplug.io) adapter for the [CakePHP](https://cakephp.org/) HTTP library.

# Deprecated

The CakePHP HTTP client implements the PSR-18 `HttpClientInterface`. If your code still relies on the HTTPlug `HttpClient`, we recommend to upgrade to rely on the compatible PSR-18 `HttpClientInterface` interface directly instead.

## Version Info

This branch is for use with CakePHP 5.0+.

- ^0.2: CakePHP 3
- ^0.3: CakePHP 4
- ^0.4: CakePHP 5

## Install

Via Composer

``` bash
$ composer require php-http/cakephp-adapter
```

## Testing

Start the development server using

``` bash
vendor/bin/http_test_server
```

Then run the test suite using

``` bash
$ composer test
```

## Contributing

Please see our [contributing guide](http://docs.php-http.org/en/latest/development/contributing.html).


## Security

If you discover any security related issues, please contact us at [security@php-http.org](mailto:security@php-http.org).


## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
