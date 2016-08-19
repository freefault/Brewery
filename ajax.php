<?php

require_once 'src/BreweryConnector.php';

if (isset($_REQUEST ['action'])) {
  $action = $_REQUEST ['action'];
} else {
  throw new Exception('Action not set');
}

switch ($action) {
  case 'randomBeer' :
    $connector = new BreweryConnector ();
    $response = $connector->getRndmBeer ();
    echo $response;
    break;

  case 'breweryBeers' :
    if (isset($_GET ['brewerID'])) {
      $brewerID = $_GET ['brewerID'];
    } else {
      throw new Exception('No brewer id set');
    }

    $connector = new BreweryConnector ();
    $response = $connector->getbreweryBeers ( $brewerID );
    echo $response;
    break;

  default :
    throw new Exception('No good action found');
    break;
}