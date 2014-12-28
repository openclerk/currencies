<?php

namespace Openclerk\Currencies;

/**
 * Represents a cryptocurrency.
 */
abstract class Cryptocurrency implements Currency, AddressableCurrency, BalanceableCurrency, CurrencyInformation {

  /**
   * @return true if this can be considered a "cryptocurrency", e.g. "btc"
   */
  public function isCryptocurrency() {
    return true;
  }

  /**
   * @return true if this can be considered a "fiat currency", e.g. "usd"
   */
  public function isFiat() {
    return false;
  }

  /**
   * @return true if this can be considered a "commodity", e.g. "ghs"
   */
  public function isCommodity() {
    return false;
  }

}
