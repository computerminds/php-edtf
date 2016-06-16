<?php

namespace ComputerMinds\EDTF;

use GuzzleHttp;

class EDTFInfo implements EDTFInfoInterface {

  protected $dateString;

  protected $apiData;
  protected $apiDataJson;

  protected $valid;

  /**
   * EDTFInfo constructor.
   *
   * @param $dateString
   *   The date string to return information about.
   */
  public function __construct($dateString) {
    $this->dateString = $dateString;
  }

  protected function ensureAPIData() {
    if (!isset($this->apiData)) {
      $client = new GuzzleHttp\Client();
      $res = $client->request('GET', 'http://digital2.library.unt.edu/edtf/isValid.json', array(
        'query' => array(
          'date' => $this->dateString,
        ),
      ));
      if ($res->getStatusCode() == 200) {
        $this->apiData = $res->getBody();
        $this->apiDataJson = json_decode($this->apiData, TRUE);
        $this->valid = $this->apiDataJson['validEDTF'] === TRUE;
      }
    }
  }

  public function isValid() {
    $this->ensureAPIData();
    return $this->valid;
  }

  public function getMin() {

  }

  public function getMax() {

  }


}