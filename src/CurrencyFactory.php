<?php

namespace Openclerk\Currencies;

/**
 * Allows software that uses this component to create
 * instances of {@code Currency}s, or {@code null} if
 * none could be found for the given code.
 */
interface CurrencyFactory {

  /**
   * @return a {@link Currency} for the given currency code, or {@code null}
   *   if none could be found
   */
  public function loadCurrency($cur);

}
