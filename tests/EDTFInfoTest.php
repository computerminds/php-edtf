<?php

class EDTFInfoTest extends PHPUnit_Framework_TestCase {

  protected $factory;

  protected function setUp() {
    $this->factory = new \ComputerMinds\EDTF\EDTFInfoFactory();
    parent::setUp();
  }

  /**
   * @dataProvider dateStringProvider
   */
  public function testGetEDTFInfo($dateString, $valid) {
    if ($valid) {
      $this->assertTrue($this->factory->create($dateString)->isValid(), 'Valid date is valid.');
    }
    else {
      $this->assertFalse($this->factory->create($dateString)->isValid(), 'Invalid date is invalid.');
    }
  }

  public function dateStringProvider() {
    $dates = array();

    $dates['1970-01-01'] = array('1970-01-01', TRUE);
    $dates['1970-85-01'] = array('1970-85-01', FALSE);

    return new ArrayIterator($dates);
  }
}
