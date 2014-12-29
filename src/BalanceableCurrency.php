<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;

/**
 * An "BalanceableCurrency" is a {@link AddressableCurrency} where we can obtain balances for
 * a given account identifier.
 */
interface BalanceableCurrency extends AddressableCurrency {

  /**
   * Get the account balance of the given account.
   * This method blocks until the balance has been obtained.
   *
   * @param $logger a logger to log info/error messages to
   * @throws {@link BalanceException} if something happened and the balance could not be obtained
   */
  public function getBalance($id, Logger $logger);

}
