<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
			<title>Distilled SCH Beer Application</title>
			
	</head>
	
	<body>
		<h1>Distilled SCH Beer Application</h1>
    		<?php
    			require_once 'BreweryConnector.php';
    			
    			$bcDB = 		new BreweryConnector();
    			$rndmBeerObj = 		$bcDB->randombeer();
    			$beerName = 		$rndmBeerObj->data->name;
    			$beerImg = 			$rndmBeerObj->data->labels->medium;
    			$beerDesc =			$rndmBeerObj->data->style->description;
    			$breweryArray = 	$rndmBeerObj->data->breweries;
    			
    		
			?> 
			
			
		<h1 id="beerName"><?php echo $beerName;?></h1>
		<img id="beerImg" alt="" src="<?php echo $beerImg;?>"></img>
		<p id="beerDesc"><?php echo $beerDesc;?></p>
		<p><?php echo $breweryArray->id;?></p>
		<button type="button" onclick="anotherBeer()">Another Beer</button>
		
		<button type="button" onclick="displayBrewerBeers()">More from this Brewer</button>

		<script>
			function anotherBeer() {
			
				<?php
				$newRndmBeerObj = 	$bcDB->randomBeer();
				?>

				document.getElementById("beerName").innerHTML = <?php echo '"'.$newRndmBeerObj->data->name.'"';?>;
				document.getElementById("beerImg").src = <?php echo '"'.$newRndmBeerObj->data->labels->medium.'"';?>;
    			document.getElementById("beerDesc").innerHTML = <?php echo '"'.$newRndmBeerObj->data->style->description.'"'?>;
    			
			}

			function displayBrewerBeers(){
					/* <?php $Brewer = $bcDB->brewerySearch($brewerID);
					echo '<p>'.json_encode($Brewer).'</p>';
					?> */
							document.getElementById("here").innerHTML = "button works";
				;
				}
			</script>
			
			

			
    </body>
</html>