<?php

namespace Openclerk\Currencies;

/**
 * A "currency" represents some unit of measurement that can
 * be converted into another "currency" unit, e.g. through an {@link Exchange}.
 * Can also cover commodities.
 *
 * This is the base interface; other interfaces will provide additional
 * functionality as necessary.
 */
interface Currency {

  /**
   * Get the unique three-letter currency code for this currency,
   * e.g. 'btc' or 'usd'. Must be lowercase.
   */
  public function getCode();

  /**
   * Get the English name of this currency, e.g. "Bitcoin" or "United States Dollar".
   */
  public function getName();

  /**
   * @return true if this can be considered a "cryptocurrency", e.g. "btc"
   */
  public function isCryptocurrency();

  /**
   * @return true if this can be considered a "fiat currency", e.g. "usd"
   */
  public function isFiat();

  /**
   * @return true if this can be considered a "commodity", e.g. "ghs"
   */
  public function isCommodity();

}
