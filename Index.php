<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
			<title>Brewery Application</title>
			
	</head>
	
	<body>
		<h1>Title</h1>
    		<?php
    		require 'Brewerydb.php';
    		require 'Exception.php';
    		
    		$bdbAPIKey = '330f3fed202e64abba35e7251844a056';
    		$randomAPIUrl = 'beer/random';
    		$randomBeerParams = array('hasLabels=Y','withBreweries=Y');
			$randomBeerCall = new Pintlabs_Service_Brewerydb($bdbAPIKey);
			$randomBeerCall->setFormat('php');
			
			try {
				$results = $randomBeerCall->request('beers', $params, 'GET');
			} catch (Exception $e) {
				$results = array('error' => $e->getMessage());
			}
			
			echo $results->data;
			
			?>
    </body>
</html>