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
		return json_encode($beerInfo);
	}

	private function requestRndmBeerFromAPI(){
		$randomParams = '/beer/random/';
		$lbldesc = '&hasLabels=Y&withBreweries=Y';
		$url = $this->getBaseURL().$randomParams.$this->getKey().$lbldesc;
		$response = file_get_contents($url);
		return $response;
		
	}
	
	private function formatAPIResponse($fullAPIResponse){
		
		$beerInfo = json_decode($fullAPIResponse);
		$output['name'] = $beerInfo->data->name;
		$output['description'] = $beerInfo->data->description;
		$output['label'] = $beerInfo->data->labels->medium;
		$breweries = $beerInfo->data->breweries;
		$first = reset($breweries);
		$output['breweryId'] = $first->id;
		$output['breweryName'] = $first->name;
		return $output;
	}
	
	public function getbreweryBeers($brewerID){
		$fullResponse = $this->requestBreweryBeerSearchFromAPI($brewerID);
		$beerDetails = $this->formatDetails($fullResponse);
		return $beerDetails;
	}
	
	private function requestBreweryBeerSearchFromAPI($brewerID){
		$brewerParam = '/brewery';
		$beersParam = '/beers/';
		$url = $this->getBaseURL().$brewerParam.$brewerID.$beersParam.$this->getKey;
		$response = file_get_contents($url);
		return $response;
			
	}
}

	


	$action = $_REQUEST['action'];


	switch($action) {
    	case 'randomBeer':
        $querier = new BreweryConnector();
        $response = $querier->getRndmBeer();
        echo $response;
        break;

    	default:
        break;
}

	switch($action) {
		case 'breweryBeers':
		$brewerID = echo $_GET['brewerID'];
		$brewerBeers = new BreweryConnector();
		$response = $brewerBeers->getbreweryBeers($brewerID);
		echo $response;
		break;

		default:
		break;
}
?>