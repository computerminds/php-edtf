<?php

namespace ComputerMinds\EDTF;

/**
 * Base interface for EDFFInfo.
 *
 * This provides the bare bones of an interface for interacting very simply with
 * EDTF dates.
 *
 * @package ComputerMinds\EDTF
 */
interface EDTFInfoInterface {
  /**
   * Determine if the EDTF string given to this instance is valid.
   *
   * @return bool
   *   TRUE if the date string can be parsed as valid, FALSE otherwise.
   */
  public function isValid();

  /**
   * Get the earliest date that this instance could represent.
   *
   * @return \DateTime
   */
  public function getMin();

  /**
   * Get the latest date that this instance could represent.
   *
   * @return \DateTime
   */
  public function getMax();
}