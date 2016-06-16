<?php

namespace ComputerMinds\EDTF;

class EDTFInfoFactory {
  /**
   * @param $dateString
   *   The string to get EDTF information for.
   *
   * @return EDTFInfoInterface
   */
  public function create($dateString) {
    return new EDTFInfo($dateString);
  }

}