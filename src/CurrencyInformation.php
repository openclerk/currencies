<?php

namespace Openclerk\Currencies;

/**
 * Adds more user information about a currency.
 */
interface CurrencyInformation {

  /**
   * Get the {@link Currency} for this {@link CurrencyInformation}.
   */
  public function getCurrency();

  /**
   * @return a URL for more information about this currency, or {@code null} if there is none
   */
  public function getURL();

  /**
   * @return an array of (url => title) community links, or an empty array if there are none
   */
  public function getCommunityLinks();

}
