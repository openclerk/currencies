<?php

namespace Openclerk\Currencies;

use \Monolog\Logger;
use \Openclerk\Config;

/**
 * Implements some basic implementations of an {@link SecurityExchange}.
 * Assumes there is a single API call that can be used to
 * list all exchanges and get all rates - {@link #fetchAllRates()}.
 */
abstract class SimpleSecurityExchange implements SecurityExchange, ExchangeInformation {

  /**
   * Fetch all securities that this security exchange currently supports.
   * Currency codes are 3-character codes and must be globally unique.
   * Security codes are any length and are unique only to a certain {@link SecurityExchange}.
   *
   * @return an array of (security, currency)
   */
  public function fetchSecurities(Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    $result = array();
    foreach ($rates as $rate) {
      $result[] = array(
        'currency' => $rate['currency'],
        'security' => $rate['security'],
      );
    }
    return $result;
  }

  /**
   * Fetch all rates for a given security, returns an array of
   * (last_trade, bid, ask, volume, available, security, currency, name, units).
   *
   * Some fields may not be present for a given exchange.
   * `volume` is the last 24h volume.
   *
   * May also return additional fields, e.g. high/low/vwap
   *
   * @return A list of rates for the currency pair
   * @throws SecurityExchangeRateException if there are no rates for the given pair
   */
  public function fetchRates($security, Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    foreach ($rates as $rate) {
      if ($rate['security'] == $security) {
        return $rate;
      }
    }
    throw new SecurityExchangeRateException("No $security rates found for '" . $this->getCode() . "' security exchange");
  }

  /**
   * Get the last traded value for the given security,
   * or {@code null} if there is none.
   */
  public function fetchLastTrade($security, Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    foreach ($rates as $rate) {
      if ($rate['security'] == $security && isset($rate['last_trade'])) {
        return $rate['last_trade'];
      }
    }
    return null;
  }

  /**
   * Get the highest price that a buyer is willing to accept for trading the
   * given security (also known as the <i>sell price</i>),
   * or {@code null} if there is none.
   */
  public function fetchBid($security, Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    foreach ($rates as $rate) {
      if ($rate['security'] == $security && isset($rate['bid'])) {
        return $rate['last_trade'];
      }
    }
    return null;
  }

  /**
   * Get the lowest price that a seller is willing to accept for trading the
   * given security (also known as the <i>buy price</i>),
   * or {@code null} if there is none.
   */
  public function fetchAsk($security, Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    foreach ($rates as $rate) {
      if ($rate['security'] == $security && isset($rate['ask'])) {
        return $rate['ask'];
      }
    }
    return null;
  }

  /**
   * Get the name of the given security,
   * or {@code null} if there is none.
   */
  public function fetchName($security, Logger $logger) {
    $rates = $this->fetchAllRates($logger);
    foreach ($rates as $rate) {
      if ($rate['security'] == $security && isset($rate['name'])) {
        return $rate['name'];
      }
    }
    return null;
  }

  /**
   * Get the 3-character code of the currency this security code is traded in.
   */
  public function fetchSecurityCurrency($security, Logger $logger) {
    $rate = $this->fetchRates($security, $logger);
    return $rate['currency'];
  }

  var $first_request = true;

  /**
   * This allows all exchanges to optionally throttle multiple repeated
   * requests based on a runtime configuration value.
   * The throttle time is selected from either the
   * `security_exchanges_NAME_throttle` or `security_exchanges_throttle` config values,
   * or three seconds;
   * which is the time in seconds to wait between repeated requests.
   */
  public function throttle(Logger $logger) {
    if (!$this->first_request) {
      $seconds = Config::get("security_exchanges_" . $this->getCode() . "_throttle", Config::get("security_exchanges_throttle", 3 /* default */));
      $logger->info("Throttling for " . $seconds . " seconds");
      set_time_limit(30 + ($seconds * 2));
      sleep($seconds);
    }
    $this->first_request = false;
  }

}
