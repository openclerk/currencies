<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;

/**
 * A "BlockCurrency" is a currency which consists of blocks in a blockchain,
 * and we can get the number of blocks that are currently present in that blockchain.
 *
 * @see BlockBalanceableCurrency
 */
interface BlockCurrency extends Currency {

  /**
   * Get the most recent block count for this currency.
   * This method blocks until the block count has been obtained.
   *
   * @param $logger a logger to log info/error messages to
   * @throws {@link BlockException} if something happened and the block count could not be obtained
   */
  public function getBlockCount(Logger $logger);

}
