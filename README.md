# Laravel Base Classes

A set of useful Laravel classes to be used across every day development.

## Table of Contents

* [Installation](#installation)
* [Usage](#usage)
* [License](#license)
* [Security Vulnerabilities](#security-vulnerabilities)

## Installation

``` bash
composer require thtg88/laravel-base-classes
```

You can publish the configuration file and views by running:
```bash
php artisan vendor:publish --provider="Thtg88\LaravelBaseClasses\LaravelBaseClassesServiceProvider"
```

## Usage

**Coming soon!**

## Development

Clone the repo:

```bash
git clone git@github.com:thtg88/laravel-base-classes.git
```

### Requirements

The Xdebug PHP extension is required, you can install it via:

```bash
pecl install xdebug
```

### Lint

Linting is performed using [PHP CS Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer), you can run that with:

```bash
composer run-script check-style
```

### Static Analysis

Static Analysis is run using [Psalm](https://github.com/vimeo/psalm), you can run that with:

```bash
composer run-script stan
```

### Tests

Tests are run using PHPUnit, you can run them using:

```bash
composer run-script test
```

### Mutation Tests

Mutation tests are run using PHPUnit to generate coverage first, and later with [Infection](https://github.com/infection/infection).

In order to run mustation tests, first run the following in order to generate the coverage in XML format in the `build` directory:

```bash
XDEBUG_MODE=coverage ./vendor/bin/phpunit \
    --coverage-xml=build/coverage-xml \
    --log-junit=build/coverage-xml/phpunit.junit.xml
```

Then you can run mutation tests with:

```bash
./vendor/bin/infection --coverage=build/coverage-xml
```

## License

Laravel Base Classes is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel Base Classes, please send an e-mail to Marco Marassi at security@marco-marassi.com. All security vulnerabilities will be promptly addressed.
