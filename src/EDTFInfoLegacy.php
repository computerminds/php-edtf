<?php

namespace ComputerMinds\EDTF;

use GuzzleHttp;

/**
 * Validate and return basic information about EDTF date strings.
 *
 * Internally we use a web service to handle date parsing etc.
 *
 * @package ComputerMinds\EDTF
 */
class EDTFInfoLegacy implements EDTFInfoValidationInterface {

  protected $dateString;

  protected $apiData;
  protected $apiDataJson;

  protected $valid = FALSE;

  /**
   * EDTFInfo constructor.
   *
   * @param $dateString
   *   The date string to return information about.
   * @param bool $lazy_load
   *   Specify if the date about the date should be lazy loaded.
   */
  public function __construct($dateString, $lazy_load = TRUE) {
    $this->dateString = $dateString;
    if (!$lazy_load) {
      $this->ensureAPIData();
    }
  }

  /**
   * Get the data about the date string from the API.
   */
  protected function ensureAPIData() {
    if (!isset($this->apiData)) {
      $client = new GuzzleHttp\Client();
      try {
        $res = $client->request('GET', 'http://digital2.library.unt.edu/edtf/isValid.json', array(
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
        $this->apiData = $res->getBody();
        $this->apiDataJson = json_decode($this->apiData, TRUE);
        $this->valid = $this->apiDataJson['validEDTF'] === TRUE;
      }
    }
  }

  /**
   * Return the validity of the EDTF date string.
   *
   * @return bool
   */
  public function isValid() {
    $this->ensureAPIData();
    return $this->valid;
  }
}
