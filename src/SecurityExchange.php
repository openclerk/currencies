<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;

/**
 * A {@link SecurityExchange} is very similar to a currency {@link Exchange},
 * except instead of (currency, currency) rates, we have security rates,
 * and each security can be denominated in a separate currency,
 * and each {@link SecurityExchange} can define its own {@link Security}s.
 */
interface SecurityExchange {

  /**
   * @return the full name of the security exchange
   */
  public function getName();

  /**
   * @return a unique string representing this security exchange; must be lowercase and 1-32 characters
   */
  public function getCode();

  /**
   * Fetch all securities that this security exchange currently supports.
   * Currency codes are 3-character codes and must be globally unique.
   * Security codes are any length and are unique only to a certain {@link SecurityExchange}.
   *
   * @return an array of (security, currency)
   */
  public function fetchSecurities(Logger $logger);

  /**
   * Fetch all rates for a given security, returns an array of
   * (last_trade, bid, ask, volume, available, security, currency).
   *
   * Some fields may not be present for a given exchange.
   * `volume` is the last 24h volume.
   *
   * May also return additional fields, e.g. high/low/vwap
   *
   * @return A list of rates for the currency pair
   * @throws SecurityExchangeRateException if there are no rates for the given security
   */
  public function fetchRates($security, Logger $logger);

  /**
   * Return a list of rates for each supported market, e.g.
   * array(array('currency' => 'usd', 'security' => 'asicminer', 'last_trade' => 1, 'bid' => 2), ...)
   *
   * @see #fetchRates($currency1, $currency2)
   */
  public function fetchAllRates(Logger $logger);

  /**
   * Get the last traded value for the given security,
   * or {@code null} if there is none.
   */
  public function fetchLastTrade($security, Logger $logger);

  /**
   * Get the highest price that a buyer is willing to accept for trading the
   * given security (also known as the <i>sell price</i>),
   * or {@code null} if there is none.
   */
  public function fetchBid($security, Logger $logger);

  /**
   * Get the lowest price that a seller is willing to accept for trading the
   * given security (also known as the <i>buy price</i>),
   * or {@code null} if there is none.
   */
  public function fetchAsk($security, Logger $logger);

  /**
   * Get the name of the given security,
   * or {@code null} if there is none.
   */
  public function fetchName($security, Logger $logger);

  /**
   * Get the 3-character code of the currency this security code is traded in.
   * @throws SecurityExchangeRateException if this isn't a valid security code for this exchange
   */
  public function fetchSecurityCurrency($security, Logger $logger);

}
