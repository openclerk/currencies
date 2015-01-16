<?php

namespace Openclerk\Currencies;

/**
 * Represents a commodity currency.
 */
abstract class CommodityCurrency implements Currency, CurrencyInformation {

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
    return false;
  }

  /**
   * @return true if this can be considered a "commodity", e.g. "ghs"
   */
  public function isCommodity() {
    return true;
  }

  public function getCurrency() {
    return this;
  }

  /**
   * Get the currency code visible to users, which can be of any length
   * and does not need to be unique (but should be). Often just the uppercase
   * of {@link #getCode()}.
   */
  public function getAbbr() {
    return strtoupper($this->getCode());
  }

  /**
   * By default, commodity currencies do not have any community links.
   * @return an array of (url => title) community links, or an empty array if there are none
   */
  public function getCommunityLinks() {
    return array();
  }

}
