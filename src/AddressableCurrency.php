<?php

namespace Openclerk\Currencies;

/**
 * An "AddressableCurrency" is a {@link Currency} which has unique account identifiers that
 * can be used to obtain balance information. For example, all cryptocurrencies
 * are AddressableCurrencies.
 *
 * The action of actually getting account balances is handled by a different interface,
 * {@link BalanceableCurrency}.
 */
interface AddressableCurrency extends Currency {

  /**
   * Is this account identifier valid for this currency?
   * @return false if this account identifier is not valid
   */
  public function isValid($id);

  /**
   * @return true if this {@link Currency} has a public explorer that can be
   * used to look at an individual account.
   */
  public function hasExplorer();

  /**
   * @return the name of the explorer, or {@code null} if there is none
   * @see #hasExplorer()
   */
  public function getExplorerName();

  /**
   * @return a public URL for the explorer, or {@code null} if there is none
   * @see #hasExplorer()
   */
  public function getExplorerURL();

  /**
   * @return a public URL for exploring the given account, or {@code null}
   * if there is none
   */
  public function getBalanceURL($id);

}
