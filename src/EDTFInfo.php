<?php

namespace ComputerMinds\EDTF;

use GuzzleHttp;

class EDTFInfo implements EDTFInfoInterface {

  protected $dateString;

  protected $apiData;
  protected $apiDataJson;

  protected $valid = FALSE;
  protected $min;
  protected $max;

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
      try {
        $res = $client->request('GET', 'http://edtf.herokuapp.com/', array(
          'query' => array(
            'date' => $this->dateString,
          ),
        ));
      }
      catch (GuzzleHttp\Exception\ServerException $guzzle_exception) {

      }
      catch (GuzzleHttp\Exception\ClientException $guzzle_exception) {

      }
      if (isset($res) && $res->getStatusCode() == 200) {
        $this->valid = TRUE;
        $this->apiData = $res->getBody();
        $this->apiDataJson = json_decode($this->apiData, TRUE);
        $this->min = new \DateTime($this->apiDataJson['min']);
        $this->max = new \DateTime($this->apiDataJson['max']);
      }
    }
  }

  public function isValid() {
    $this->ensureAPIData();
    return $this->valid;
  }

  /**
   * @return \DateTime;
   */
  public function getMin() {
    $this->ensureAPIData();
    return $this->min;

  }

  /**
   * @return \DateTime;
   */
  public function getMax() {
    $this->ensureAPIData();
    return $this->max;
  }


}