<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;

/**
 * A "BlockBalanceableCurrency" is a currency in which we can get the balance at a certain block number.
 *
 * @see BlockCurrency
 * @see ConfirmableCurrency
 */
interface BlockBalanceableCurrency extends Currency {

  /**
   * Get the balance at the given block number.
   * This allows us to cache the block number and not have to request it on every
   * balance request.
   *
   * @param $block the block number, or {@code null} to get the most recent balance
   * @throws {@link BalanceException} if something happened and the block count could not be obtained
   */
  public function getBalanceAtBlock($address, $block, Logger $logger);

}
