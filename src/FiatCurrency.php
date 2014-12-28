<?php

namespace Openclerk\Currencies;

/**
 * Represents a fiat currency.
 */
abstract class FiatCurrency implements Currency, CurrencyInformation {

  /**
   * @return true if this can be considered a "cryptocurrency", e.g. "btc"
   */
  public function isCryptocurrency() {
    return false;
  }

  /**
   * @return true if this can be considered a "fiat currency", e.g. "usd"
   */
  public function isFiat() {
    return true;
  }

  /**
   * @return true if this can be considered a "commodity", e.g. "ghs"
   */
  public function isCommodity() {
    return false;
  }

}
