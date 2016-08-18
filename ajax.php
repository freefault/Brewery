<?php

require_once 'src/BreweryConnector.php';

$action = $_REQUEST ['action'];

switch ($action) {
	case 'randomBeer' :
		$querier = new BreweryConnector ();
		$response = $querier->getRndmBeer ();
		echo $response;
		break;
	case 'breweryBeers' :
		$brewerID = $_GET ['brewerID'];
		$brewerBeers = new BreweryConnector ();
		$response = $brewerBeers->getbreweryBeers ( $brewerID );
		echo $response;
		break;
	
	default :
		throw new Exception('No action found');
		break;
}
