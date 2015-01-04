<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;

/**
 * A "MultiBalanceableCurrency" is a {@link AddressableCurrency} where we can obtain multiple balances
 * in multiple currencies for a given account identifier.
 *
 * A {@link MultiBalanceableCurrency} may also be a {@link BalanceableCurrency} if there is a single currency
 * balance which is the prime balance for that account.
 */
interface MultiBalanceableCurrency extends AddressableCurrency {

  /**
   * Get the account balances, in an array of (currency code => balance), of the given account.
   * This method blocks until the balances have been obtained.
   *
   * @param $logger a logger to log info/error messages to
   * @throws {@link BalanceException} if something happened and the balance could not be obtained
   * @return an array of (currency code => balance)
   */
  public function getMultiBalances($id, Logger $logger);

}
