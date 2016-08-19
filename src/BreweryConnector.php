<?php
class BreweryConnector {

  /**
   * TODO store this somewhere other than code
   *
   * @return string
   */
  private function getKey() {
    $myAPIKey = '?key=330f3fed202e64abba35e7251844a056';
    return $myAPIKey;
  }

  /**
   * Get the url of the api
   *
   * @return string
   */
  private function getBaseURL() {
    $baseURL = 'http://api.brewerydb.com/v2';
    return $baseURL;
  }

  /**
   * Get a json string with the details of a random beer
   *
   * @return string
   */
  public function getRndmBeer() {
    $fullAPIResponse = $this->requestRndmBeerFromAPI ();
    $beerInfo = $this->formatSingleBeerAPIResponse ( $fullAPIResponse );
    return json_encode ( $beerInfo );
  }

  /**
   * Query the brewerydb api and get a random beer
   *
   * @return string
   */
  private function requestRndmBeerFromAPI() {
    $randomParams = '/beer/random/';
    $lbldesc = '&hasLabels=Y&withBreweries=Y';
    $url = $this->getBaseURL () . $randomParams . $this->getKey () . $lbldesc;
    $response = file_get_contents ( $url );
    return $response;
  }

  /**
   * Pull out the details from the brewerydb response for a random beer and put them in a format for the index page
   *
   * @param $fullAPIResponse
   * @return mixed
   */
  private function formatSingleBeerAPIResponse($fullAPIResponse) {
    $beerInfo = json_decode ( $fullAPIResponse );
    if (is_null($beerInfo) || !isset($beerInfo->data)) {
      throw new Exception('Bad Response from BreweryDB');
    }

    $output ['name'] = $beerInfo->data->name;
    $output ['description'] = $beerInfo->data->description;
    $output ['label'] = $beerInfo->data->labels->medium;
    $breweries = $beerInfo->data->breweries;
    $first = reset ( $breweries );
    $output ['breweryId'] = $first->id;
    $output ['breweryName'] = $first->name;
    return $output;
  }

  /**
   * Contact the api and get a search result for a brewery and then format it for the index page
   *
   * @param string $brewerID
   * @return string
   */
  public function getbreweryBeers($brewerID) {
    $fullResponse = $this->requestBreweryBeerSearchFromAPI ( $brewerID );
    $beerDetails = $this->formatMultipleBeerAPIResponse ( $fullResponse );
    return json_encode($beerDetails);
  }

  /**
   * Get the beers for a brewery from the api
   *
   * @param string $brewerID
   * @return string
   */
  private function requestBreweryBeerSearchFromAPI($brewerID) {
    $brewerParam = '/brewery/';
    $beersParam = '/beers';
    $url = $this->getBaseURL () . $brewerParam . $brewerID . $beersParam . $this->getKey ();
    $response = file_get_contents ( $url );

    return $response;
  }

  /**
   * Pull out the details from the breweydb response for a search and put them in a format for the index page
   *
   * @param $fullAPIResponse
   * @return mixed
   */
  private function formatMultipleBeerAPIResponse($fullAPIResponse) {
    $beerInfo = json_decode ( $fullAPIResponse );
    if (is_null($beerInfo) || !isset($beerInfo->data)) {
      throw new Exception('Bad Response from BreweryDB');
    }

    $beerArray = $beerInfo->data;
    $output = array ();
    foreach ( $beerArray as $singleBeer ) {
      $mybeer = array ();
      $mybeer ['name'] = $singleBeer->name;
      $mybeer ['description'] = $singleBeer->description;
      $mybeer ['label'] = $singleBeer->labels->icon;
      $output [] = $mybeer;
    }
    return $output;
  }
}