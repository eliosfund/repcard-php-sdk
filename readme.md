# RepCard

[![Test Suite](https://github.com/eliosfund/repcard-php-sdk/actions/workflows/test.yml/badge.svg)](https://github.com/eliosfund/repcard-php-sdk/actions/workflows/test.yml)
![Downloads](https://img.shields.io/packagist/dm/eliosfund/repcard-php-sdk)
![Packagist Version](https://img.shields.io/packagist/v/eliosfund/repcard-php-sdk)
![GitHub License](https://img.shields.io/github/license/eliosfund/repcard-php-sdk)
[![codecov](https://codecov.io/gh/eliosfund/repcard-php-sdk/graph/badge.svg?token=Kl42g7GBRz)](https://codecov.io/gh/eliosfund/repcard-php-sdk)

RepCard SDK for Laravel.

## Installation

Install the package via Composer:

```bash
composer require eliosfund/repcard-php-sdk
```

Publish the config file:

```bash
php artisan vendor:publish --tag=repcard-config
```

Set the following environment variables in your `.env` file:

```dotenv
REPCARD_API_KEY=your-api-key
REPCARD_COMPANY_ID=your-company-id
```

In `config/repcard.php`, add the role names you want to allow when creating or updating a user, e.g.:

```php
'roles' => [
    'Sales',
    'Sales Manager',
],
```

## Usage

```php
use RepCard\Facades\RepCard;
```
