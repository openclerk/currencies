<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;

/**
 * A "ConfirmableCurrency" is a currency which can get the balance with a given number of confirmations.
 * It should probably also extend BlockCurrency.
 */
interface ConfirmableCurrency extends Currency {

  /**
   * Get the balance at the given number of confirmations.
   * If this is also a {@link BlockBalanceableCurrency} then we can emulate this through {@link #getBalanceAtBlock()}.
   *
   * @param $confirmations the number of confirmations to use
   * @throws {@link BalanceException} if something happened and the balance could not be obtained
   */
  public function getBalanceWithConfirmations($address, $confirmations, Logger $logger);

}
