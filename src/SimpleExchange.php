<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;
use \Openclerk\Config;

/**
 * Implements some basic implementations of an {@link Exchange}.
 * Assumes there is a single API call that can be used to
 * list all exchanges and get all rates - {@link #fetchAllRates()}.
 */
abstract class SimpleExchange implements Exchange, ExchangeInformation {

  /**
   * Each of these pairs represents a market, e.g. 'btc', 'usd'
   * These pairs can be in any (a, b) order, because we should (in theory) be
   * able to swap last/bid/ask as necessary.
   *
   * @return an array of (from, to) 3-character {@link Currency} codes
   */
  public function fetchMarkets(Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    $result = array();
    foreach ($rates as $key => $ignored) {
      $result[] = array(substr($key, 0, 3), substr($key, 3, 3));
    }
    return $result;
  }

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
  public function fetchRates($currency1, $currency2, Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    $key = $currency1 . $currency2;
    if (isset($rates[$key])) {
      return $rates[$key];
    } else {
      throw new ExchangeRateException("No $currency1/$currency2 rates found for '" . $this->getCode() . "' exchange");
    }
  }

  /**
   * Get the last traded value for the given currency pair,
   * or {@code null} if there is none.
   */
  public function fetchLastTrade($currency1, $currency2, Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    $key = $currency1 . $currency2;
    if (isset($rates[$key]['last_trade'])) {
      return $rates[$key]['last_trade'];
    } else {
      return null;
    }
  }

  /**
   * Get the highest price that a buyer is willing to accept for trading the
   * given pair (also known as the <i>sell price</i>),
   * or {@code null} if there is none.
   */
  public function fetchBid($currency1, $currency2, Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    $key = $currency1 . $currency2;
    if (isset($rates[$key]['bid'])) {
      return $rates[$key]['bid'];
    } else {
      return null;
    }
  }

  /**
   * Get the lowest price that a seller is willing to accept for trading the
   * given pair (also known as the <i>buy price</i>),
   * or {@code null} if there is none.
   */
  public function fetchAsk($currency1, $currency2, Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    $key = $currency1 . $currency2;
    if (isset($rates[$key]['ask'])) {
      return $rates[$key]['ask'];
    } else {
      return null;
    }
  }

  var $first_request = true;

  /**
   * This allows all exchanges to optionally throttle multiple repeated
   * requests based on a runtime configuration value.
   * The throttle time is selected from either the
   * `exchanges_NAME_throttle` or `exchanges_throttle` config values,
   * or three seconds;
   * which is the time in seconds to wait between repeated requests.
   */
  public function throttle(Logger $logger) {
    if (!$this->first_request) {
      $seconds = Config::get("exchanges_" . $this->getCode() . "_throttle", Config::get("exchanges_throttle", 3 /* default */));
      $logger->info("Throttling for " . $seconds . " seconds");
      set_time_limit(30 + ($seconds * 2));
      sleep($seconds);
    }
    $this->first_request = false;
  }

}
