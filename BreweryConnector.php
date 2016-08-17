	<?php
	class BreweryConnector{
	private $myAPIKey = '?key=330f3fed202e64abba35e7251844a056';
	private $baseURL = 'http://api.brewerydb.com/v2/';

	private function getKey(){
		$myAPIKey = '?key=330f3fed202e64abba35e7251844a056';
		return $myAPIKey;
	}

	private function getBaseURL(){
		$baseURL = 'http://api.brewerydb.com/v2';
		return $baseURL;
	}

	public function getRndmBeer(){
		$fullAPIResponse = $this->requestRndmBeerFromAPI();
		$beerInfo = $this->formatAPIResponse($fullAPIResponse);
		return $beerInfo;
	}

	private function requestRndmBeerFromAPI(){
		$randomParams = '/beer/random/';
		$lbldesc = '&hasLabels=Y&withBreweries=Y';
		$url = html_entity_decode($this->getBaseURL().$randomParams.$this->getKey().$lbldesc);
		$response = file_get_contents($url);
		$apiOutPut = json_decode($response);
		return $apiOutput;
	}
	
	private function formatAPIResponse($fullAPIResponse){
		$beerInfo = json_decode($fullAPIResponse);
		$output['name'] = $beerInfo->data->name;
		$output['description'] = $beerInfo->data->description;
		$output['label'] = $beerInfo->data->labels->large;
		$breweries = $beerInfo->data->breweries;
		$first = reset($breweries);
		$output['breweryId'] = $first->id;
		$output['breweryName'] = $first->name;
		return $output;
	}
}




	$action = $_REQUEST['action'];


	switch($action) {
    	case 'random':
        $querier = new BreweryConnector();
        $response = $querier->getRndmBeer();
        echo $response;
        break;

    	default:
        break;
}
?>