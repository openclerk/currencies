<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;

/**
 * A "ReceivedCurrency" is a {@link AddressableCurrency} where we can obtain <i>received</i> balances for
 * a given account identifier.
 * @see BalanceableCurrency
 */
interface ReceivedCurrency extends AddressableCurrency {

  /**
   * Get the <i>received</i> account balance of the given account.
   * This method blocks until the balance has been obtained.
   *
   * @param $logger a logger to log info/error messages to
   * @throws {@link BalanceException} if something happened and the balance could not be obtained
   */
  public function getReceived($id, Logger $logger);

}
