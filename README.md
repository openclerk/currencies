openclerk/currencies [![Build Status](https://travis-ci.org/openclerk/currencies.svg)](https://travis-ci.org/openclerk/currencies)
====================

A library for defining different types of currencies: cryptocurrencies, fiat currencies, and commodity currencies.
Used by [Openclerk](http://openclerk.org) and live on [CryptFolio](https://cryptfolio.com).

This library only provides interface and abstract definitions.
The actual definitions of currencies is provided by other components, such as
[openclerk/cryptocurrencies](https://github.com/openclerk/cryptocurrencies),
[openclerk/fiat](https://github.com/openclerk/fiat), and
[openclerk/commodities](https://github.com/openclerk/commodities).
This allows additional currencies to be provided or [discovered](https://github.com/soundasleep/component-discovery) at runtime.

## Installing

Include `openclerk/currencies` as a requirement in your project `composer.json`,
and run `composer update` to install it into your project:

```json
{
  "require": {
    "openclerk/currencies": "dev-master"
  }
}
```

* [Cryptocurrencies supported](https://github.com/openclerk/cryptocurrencies/tree/master/src)
* [Fiat currencies supported](https://github.com/openclerk/fiat/tree/master/src)
* [Commodity currencies supported](https://github.com/openclerk/commodities/tree/master/src)
* Live API: [https://cryptfolio.com/api/v1/currencies](https://cryptfolio.com/api/v1/currencies)

## Donate

[Donations are appreciated](https://code.google.com/p/openclerk/wiki/Donating).

## TODO

1. CI build server and link to test results
