<?php

namespace Openclerk\Currencies;

/**
 * Represents an exchange which can be used to convert one value of
 * {@link Currency} into another value of another {@link Currency}.
 *
 * An {@link Exchange} does not provide conversion functionality;
 * this can be done naively with {@link #getLastTrade()}, or through
 * a {@link ConvertingExchange} interface, which defines
 * trade strategies.
 *
 * This is the base interface; other interfaces will provide additional
 * functionality as necessary.
 */
interface Exchange {

  /**
   * @return the name of the exchange
   */
  public function getName();

  /**
   * @return the URL of the exchange, or {@code null}
   */
  public function getURL();

  /**
   * @return a unique string representing this exchange; must be lowercase
   */
  public function getCode();

  /**
   * Each of these pairs represents a market, e.g. ('btc', 'usd')
   * These pairs can be in any (a, b) order, because we should (in theory) be
   * able to swap last/bid/ask as necessary.
   *
   * @return an array of (from, to) 3-character {@link Currency} codes
   */
  public function getMarkets();

  /**
   * Get the last traded value for the given currency pair,
   * or {@code null} if there is none.
   */
  public function getLastTrade($currency1, $currency2);

  /**
   * Get the highest price that a buyer is willing to accept for trading the
   * given pair (also known as the <i>sell price</i>),
   * or {@code null} if there is none.
   */
  public function getBid($currency1, $currency2);

  /**
   * Get the lowest price that a seller is willing to accept for trading the
   * given pair (also known as the <i>buy price</i>),
   * or {@code null} if there is none.
   */
  public function getAsk($currency1, $currency2);

  // TODO add these methods to ConvertingExchange interface

  // public function getLastTradeValue($currency1, $currency2, $value1);
  // - simply getLastTrade($currency1, $currency2) * $value1

  // public function getMarketValue($currency1, $currency2, $value1);
  // - only returns non-null if the exchange tracks market depth as well

}
