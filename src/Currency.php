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
   * e.g. 'btc' or 'usd'. Must be lowercase. This is not visible to users.
   */
  public function getCode();

  /**
   * Get the currency code visible to users, which can be of any length
   * and does not need to be unique (but should be). Often just the uppercase
   * of {@link #getCode()}.
   */
  public function getAbbr();

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
