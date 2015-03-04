<?php

namespace Openclerk\Currencies;

/**
 * A "HashAlgorithm" represents some type of algorithm used to hash
 * a cryptocurrency. The performance of the algorithm can be measured in some way,
 * in <i>operations per second</i>.
 *
 * This is the base interface; other interfaces will provide additional
 * functionality as necessary.
 */
abstract class HashAlgorithm {

  /**
   * Get the unique 1-32 character algorithm code for this algorithm,
   * e.g. 'sha256' or 'scrypt'. Must be lowercase. This is not visible to users.
   */
  abstract function getCode();

  /**
   * For some currencies, hashrates are normally measured in kh/s (divisor = 1e3);
   * for some currencies, hashrates are normally measured in MH/s (divisor = 1e6);
   * for some currencies, hashrates are normally measured in GH/s (divisor = 1e9).
   *
   * @return by default, 1e3
   */
  public function getDivisor() {
    return 1e3;
  }

  /**
   * Get the user-visible text for this divisor.
   * By default, generates the text based on {@link #getDivisor()}.
   */
  public function getDivisorText() {
    switch ($this->getDivisor()) {
      case 1:
        return "H/s";

      case 1e3:
        return "KH/s";

      case 1e6:
        return "MH/s";

      case 1e9:
        return "GH/s";

      case 1e12:
        return "TH/s";

      default:
        throw new \InvalidArgumentException("Unknown divisor text for divisor " . $this->getDivisor());
    }
  }

  /**
   * Get the English name of this algorithm, e.g. "SHA-256" or "Scrypt".
   */
  abstract function getName();

}
