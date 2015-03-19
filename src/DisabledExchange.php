<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;

/**
 * Represents a historical exchange which has now been disabled, either
 * permanently or temporarily. Calling any fetch methods on this
 * exchange may return errors.
 */
interface DisabledExchange {

  /**
   * @return the date that this exchange was disabled
   */
  public function disabledAt();

}
