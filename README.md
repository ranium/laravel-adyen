# Laravel Adyen

## Description ##
A Laravel 5.4+ package/wrapper for Adyen API Library. [Adyen](https://www.adyen.com/) is a leading payment processor supporting multiple channels of payment on a single platform.

## Reference ##
This package is a wrapper for [Adyen PHP API Library](https://github.com/Adyen/adyen-php-api-library/). For detailed usage and API reference, please read base library's [documentation](http://adyen.github.io/adyen-php-api-library/).

## Installation ##
Install using composer:

```sh
composer require ranium/laravel-adyen
```

## Configuration ##
After installation, publish the adyen config file:

```sh
php artisan vendor:publish --provider="Ranium\LaravelAdyen\AdyenServiceProvider"
```

The above command will create `LARAVEL_ROOT/config/adyen.php` configuration file.

NOTE: This package supports configuring multiple adyen merchant accounts. You can even define company wide settings which are then merged with merchant account specific settings when the package is instantiated. This is very useful for those companies which have some settings (like web service username and password) common across all their merchant accounts. They will only need to define such settings once which will be merged with merchant account settings. The `config/adyen.php` file is very well documented and please refer the same for the usage/configuration.

## Basic Usage ##
This package is primarily used to instantiate the `\Adyen\Client` class. The Adyen client is then passed on to various services like Payments, Recurring, Refunds etc.
```php
$request = [
    'additionalData' => [
        // Client side encrypted card data. See adyen documentation for more info.
        'card.encrypted.json' => 'adyenjs_0_1_19$tfnNpk+3IbAAFJ...',
    ],
    'amount' => [
        'value' => 1050,
        'currency' => 'GBP',
    ],
    // Unique reference. This will be your order number or something similar
    'reference' => 'test-' . time(),
    // Merchant account to use
    'merchantAccount' => config('adyen.accounts.default.merchantAccount'),
    'shopperEmail' => 'abbas@ranium.in',
    'shopperIP' => '123.123.10.10',
];

// Make the adyen client
$client = App::make(\Adyen\Client::class);

// Instantiate the Payment service
$service = new \Adyen\Service\Payment($client);

try {
    $response = $service->authorise($request);
} catch (\Adyen\AdyenException $e) {
    // Handle the error message
    dd($e->getMessage());
}
```