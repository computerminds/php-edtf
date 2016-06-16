<?php

namespace ComputerMinds\EDTF;

interface EDTFInfoInterface {
  public function isValid();

  public function getMin();
  public function getMax();
}