# Omnipay: PayOp [in progress]

**PayOp gateway for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. 
This package implements PayOp support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```
{
    "require": {
        "mekaeil/omnipay-payop": "~1.0"
    }
}
```

or run this command:
```
composer require mekaeil/omnipay-payop
```

## Fetching Payment Methods

```
$initialize_data = [
    'token'     => env('PAYOP_TOKEN'),
    'publicKey' => env('PAYOP_PUBLIC_KEY'),
    'secretKey' => env('PAYOP_SECRET_KEY'),
    'language'  => 'en',
    'testMode'  => env('PAYOP_IS_TEST', false),
];

$gateway = Omnipay::create('PayOp');
$gateway->initialize( $initialize_data );

$response = $gateway->fetchPaymentMethods([])->send();

if($response->isSuccessful()){
    return $response->getPaymentMethods();
}
```