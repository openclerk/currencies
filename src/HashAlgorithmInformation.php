<?php

namespace Openclerk\Currencies;

/**
 * Adds more user information about a hash algorithm.
 */
interface HashAlgorithmInformation {

  /**
   * @return the URL of the hash algorithm, or {@code null}
   */
  public function getURL();

}
