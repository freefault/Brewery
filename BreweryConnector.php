	<?php
	class BreweryConnector{
	private $myAPIKey = '?key=330f3fed202e64abba35e7251844a056';
	private $baseURL = 'http://api.brewerydb.com/v2/';
	
	
	function randombeer() {
		
		$randomParams = 'beer/random/';
		$lbldesc = '&hasLabels=Y&withBreweries=Y';
		
		
		$request = $this->baseURL.$randomParams.$this->myAPIKey.$lbldesc;
		$response = file_get_contents($request);
    	$jsonobj = json_decode($response);
    	return $jsonobj;
		
	}
	
	function brewerySearch($brewerID){
		$breweryParam = '/brewery/'.$brewerID.'/beers/';
		$request = $this->baseURL.$breweryParam.$this->myAPIKey;
		$response = file_get_contents($request);
		$jsonobj = json_decode($response);
		return $request;
	}
}

?>