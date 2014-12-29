<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;

/**
 * A "DifficultyCurrency" is a currency which has an associated difficulty,
 * and we can get the current difficulty of that currency.
 */
interface DifficultyCurrency extends Currency {

  /**
   * Get the most recent difficulty for this currency.
   * This method blocks until the balance has been obtained.
   *
   * @param $logger a logger to log info/error messages to
   * @throws {@link DifficultyException} if something happened and the block count could not be obtained
   */
  public function getDifficulty(Logger $logger);

}
