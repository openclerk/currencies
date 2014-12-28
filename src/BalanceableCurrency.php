<?php

namespace Openclerk\Currencies;

/**
 * An "BalanceableCurrency" is a {@link AddressableCurrency} where we can obtain balances for
 * a given account identifier.
 */
interface BalanceableCurrency extends AddressableCurrency {

  /**
   * Get the account balance of the given account.
   * This method blocks until the balance has been obtained.
   */
  public function getBalance($id);

}
