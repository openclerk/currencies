<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;

/**
 * Represents an exchange which can be used to convert one value of
 * {@link Currency} into another value of another {@link Currency}.
 *
 * An {@link Exchange} does not provide conversion functionality;
 * this can be done naively with {@link #getLastTrade()}.
 *
 * This is the base interface; other interfaces will provide additional
 * functionality as necessary.
 */
interface Exchange {

  /**
   * @return the full name of the exchange
   */
  public function getName();

  /**
   * @return a unique string representing this exchange; must be lowercase and 1-32 characters
   */
  public function getCode();

  /**
   * Each of these pairs represents a market, e.g. ('btc', 'usd')
   * These pairs can be in any (a, b) order, because we should (in theory) be
   * able to swap last/bid/ask as necessary.
   *
   * @return an array of (from, to) 3-character {@link Currency} codes
   */
  public function fetchMarkets(Logger $logger);

  /**
   * Fetch all rates for a given currency, returns an array of
   * (last_trade, bid, ask, volume).
   * Some fields may not be present for a given exchange.
   * `volume` is the last 24h volume.
   * May also return additional fields.
   *
   * @return A list of rates for the currency pair
   * @throws ExchangeRateException if there are no rates for the given pair
   */
  public function fetchRates($currency1, $currency2, Logger $logger);

  /**
   * Return a list of rates for each supported market, e.g.
   * array('usdbtc' => array('last_trade' => 1, 'bid' => 2), ...)
   *
   * @see #fetchRates($currency1, $currency2)
   */
  public function fetchAllRates(Logger $logger);

  /**
   * Get the last traded value for the given currency pair,
   * or {@code null} if there is none.
   */
  public function fetchLastTrade($currency1, $currency2, Logger $logger);

  /**
   * Get the highest price that a buyer is willing to accept for trading the
   * given pair (also known as the <i>sell price</i>),
   * or {@code null} if there is none.
   */
  public function fetchBid($currency1, $currency2, Logger $logger);

  /**
   * Get the lowest price that a seller is willing to accept for trading the
   * given pair (also known as the <i>buy price</i>),
   * or {@code null} if there is none.
   */
  public function fetchAsk($currency1, $currency2, Logger $logger);

}
