Laravel 4.2 Framework - Unofficial LTS
===

[![Build Status](https://travis-ci.org/NeverBounce/framework.svg?branch=4.2)](https://travis-ci.org/NeverBounce/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

> **Note:** This repository is an unofficial fork of the Laravel 4.2 Framework. The maintainers of this repository are not affiliated with the Laravel project.

Without a clear upgrade path to Laravel 5.x, older 4.2 applications can be difficult to modernize without a complete rewrite. This fork is intended to breath some new life into these applications when a rewrite isn't possible.

## Installation

This fork is only available as an [artifact](https://getcomposer.org/doc/05-repositories.md#artifact) and is not available on Packagist.

1. To get started first download the latest release from the [release page](https://github.com/NeverBounce/framework/releases). 
2. Create a new directory called `artifacts` in the same location as your composer.json file. 
3. Place the zip file downloaded from the release page into this new folder.
4. Add the following entry in your `composer.json` file:

    ```json
    "repositories": [
        {
          "type": "artifact",
          "url": "./artifacts"
        }
      ],
    ```
 
5. Add `"laravel/framework": "^4.2"` to your `composer.json` dependencies if it's not already there. 
6. Run `composer update` to update the framework.

## Changes

This project does not follow Semantic Versioning. Refer to the changes below to see what's changed.

- PHP 7.x `Throwable` and exception handling updates
- Dropped support for PHP `5.x`
- Updated Whoops to `^2.1`
- Updated PHPUnit to `^6.1` **(Breaking change)**
- Updated other dependencies to most recent versions
- Added support for plaintext cookies (Laravel 5.x feature)
- Added `Auth::logoutOtherDevices()` (Laravel 5.x feature)
- Removed Mcrypt requirement, Encryptor now uses OpenSSL (Laravel 5.x compatibility)
- Added support for PHP 7.1+
- Upgraded Symfony components to `2.8.*`

Original Readme:
===

> **Note:** This repository contains the core code of the Laravel framework. If you want to build an application using Laravel 4, visit the main [Laravel repository](https://github.com/laravel/laravel).

## Laravel PHP Framework

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
