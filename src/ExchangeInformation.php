<?php

namespace Openclerk\Currencies;

/**
 * Adds more user information about an exchange.
 */
interface ExchangeInformation {

  /**
   * @return the URL of the exchange, or {@code null}
   */
  public function getURL();

}
