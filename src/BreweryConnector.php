<?php
	class BreweryConnector {
	
	private function getKey() {
		$myAPIKey = '?key=330f3fed202e64abba35e7251844a056';
		return $myAPIKey;
	}
	private function getBaseURL() {
		$baseURL = 'http://api.brewerydb.com/v2';
		return $baseURL;
	}
	public function getRndmBeer() {
		$fullAPIResponse = $this->requestRndmBeerFromAPI ();
		$beerInfo = $this->formatSingleBeerAPIResponse ( $fullAPIResponse );
		return json_encode ( $beerInfo );
	}
	private function requestRndmBeerFromAPI() {
		$randomParams = '/beer/random/';
		$lbldesc = '&hasLabels=Y&withBreweries=Y';
		$url = $this->getBaseURL () . $randomParams . $this->getKey () . $lbldesc;
		$response = file_get_contents ( $url );
		return $response;
	}
	private function formatSingleBeerAPIResponse($fullAPIResponse) {
		$beerInfo = json_decode ( $fullAPIResponse );
		$output ['name'] = $beerInfo->data->name;
		$output ['description'] = $beerInfo->data->description;
		$output ['label'] = $beerInfo->data->labels->medium;
		$breweries = $beerInfo->data->breweries;
		$first = reset ( $breweries );
		$output ['breweryId'] = $first->id;
		$output ['breweryName'] = $first->name;
		return $output;
	}
	private function formatMultipleBeerAPIResponse($fullAPIResponse) {
		$beerInfo = json_decode ( $fullAPIResponse );
		$beerArray = $beerInfo->data;
		$output = array ();
		foreach ( $beerArray as $singleBeer ) {
			$mybeer = array ();
			$mybeer ['name'] = $singleBeer->name;
			$mybeer ['description'] = $singleBeer->description;
			$mybeer ['label'] = $singleBeer->labels->medium;
			$output [] = $mybeer;
			 
		}
		return $output;
	}
	public function getbreweryBeers($brewerID) {
		$fullResponse = $this->requestBreweryBeerSearchFromAPI ( $brewerID );
		$beerDetails = $this->formatMultipleBeerAPIResponse ( $fullResponse );
		return json_encode($beerDetails);
	}
	private function requestBreweryBeerSearchFromAPI($brewerID) {
		$brewerParam = '/brewery/';
		$beersParam = '/beers';
		$url = $this->getBaseURL () . $brewerParam . $brewerID . $beersParam . $this->getKey ();
		$response = file_get_contents ( $url );
		
		return $response;
	}
}

	