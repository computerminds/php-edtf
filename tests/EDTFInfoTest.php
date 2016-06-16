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

    $valid_dates = array(
      // 5.1.1 Date
      '1970-01-01',

      //5.1.2 Date and Time
      '2001-02-03T09:30:01',
      '2004-01-01T10:10:10Z',
      '2004-01-01T10:10:10+05:00',

      // 5.1.3 Interval
      '1964/2008',
      '2004-06/2006-08',
      '2004-02-01/2005-02-08',
      '2004-02-01/2005-02',
      '2004-02-01/2005',
      '2005/2006-02',

      // 5.2.1 Uncertain/Approximate
      '1984?',
      '2004-06?',
      '2004-06-11?',
      '1984~',
      '1984?~',

      // 5.2.2 Unspecified
      '199u',
      '19uu',
      '1999-uu',
      '1999-01-uu',
      '1999-uu-uu',

      // 5.2.3. Extended Interval (L1)
      '2004-06-01/unknown',
      '2004-01-01/open',
      '1984~/2004-06',
      '1984/2004-06~',
      '1984?/2004?~',

      // 5.2.4 Year Exceeding Four Digits (L1)
      'y170000002',
      'y-170000002',

      // 5.3.1 Partial Uncertain/Approximate
      '2001-21',
      '2004?-06-11',
      '2004-06~-11',
      '2004-(06)?-11',
      '2004-06-(11)~',
      '2004-(06)?~',
      '2004-(06-11)?',
      '2004?-06-(11)~',
      '(2004-(06)~)?',
      '2004?-(06)?~',
      '(2004)?-06-04~',
      '(2011)-06-04~',
      '2011-(06-04)~',
      '2011-23~',

      // 5.3.2 Partial Unspecified
      '156u-12-25',
      '15uu-12-25',
      '15uu-12-uu',
      '1560-uu-25',

      // 5.3.3 One of a Set
      '',
      '',
      '',
      '',
      '',
      '',
      '',
      '',
      '',
      '',
      '',

    );
    foreach ($valid_dates as $date) {
      if (!empty($date)) {
        $dates[$date] = array($date, TRUE);
      }
    }
    
    $dates['1970-85-01'] = array('1970-85-01', FALSE);

    return new ArrayIterator($dates);
  }
}
