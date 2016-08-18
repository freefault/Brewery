<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Distilled SCH Beer Application</title>

</head>
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>

	
    $(document).ready(function(){
    $("#randomButton").click(function() {
        randomBeer();
    });

    $("#moreFromBrewery").click(function() {
    	breweryBeers();
    });

        //the first one
        randomBeer();
    });


    function randomBeer()
    {
        $.ajax({
            url: "ajax.php?action=randomBeer",
            success: function (result) {
                $("#errorText").hide();
                console.log(result);
                var parsedResult = JSON.parse(result);
                $("#beerLabel").attr("src", parsedResult.label);
                $("#beerName").html(parsedResult.name);
                $("#beerDesc").html(parsedResult.description);
                $("#breweryID").hide();
                $("#breweryID").html(parsedResult.breweryId);
            },
            error: function (result) {
                console.log(result);
                $("#errorText").html("An Error Occurred");
                $("#errorText").show();
            }
        });
    }
        function breweryBeers()
        {
            $.ajax({

                
                url: "ajax.php?action=breweryBeers",
                data: {brewerID : $("#breweryID").text()},
                success: function (result) {
                    $("#errorText").hide();
                    var parsedResult = JSON.parse(result);
                    $("#searchedBeerDetails").empty();
                    for (i= 0; i < parsedResult.length; i++){
                    console.log(parsedResult[i].name);
                    $("#searchedBeerDetails").append("<p id='Beer_" + i + "'>" + parsedResult[i].name + "</p>");
                    if(parsedResult[i].description !== null)
                    $("#searchedBeerDetails").append("<p id='Beer_" + i + "'>" + parsedResult[i].description + "</p>");
                    if(parsedResult[i].label !== null)
                    $("#searchedBeerDetails").append("<img id='Beer_" + i + "' src='>" + parsedResult[i].label + "'</p>");
                    
					}

                },
                error: function (result) {
                    console.log(result);
                    $("#errorText").html("An Error Occurred");
                    $("#errorText").show();
                }
            });
        }
        

    </script>
<body>

	<div>

		<div id="errorText"></div>
		<div id="beerDetails">

			<h1 id="beerName"></h1>
			<img alt="" src="" id="beerLabel"></img> <a id="beerDesc"></a>
			<p id="breweryID"></p>

		</div>


		<div id="buttons">
			<button id="randomButton" class="ui-button ui-widget ui-corner-all">Another
				Beer</button>
			<button id="moreFromBrewery" 
					class="ui-button ui-widget ui-corner-all">More From this Brewery</button>
				</div>
		<div>
		<form action="">
			<input type="text" id="searchQuery"></input>
			<input type="radio" name="SearchRadio" value="Brewery" checked="checked">Brewery</input>
			<input type="radio" name="SearchRadio" value="Beer">Beer</input>
			<button id="search" 
					class="ui-button ui-widget ui-corner-all">Search</button>
					</form>
		</div>
	</div>

	<div id="searchedBeerDetails">
		<h1 id="searchedBeerName"></h1>
		<img alt="" src="" id="searchedBeerLabel"></img> <a
			id="searchedBeerDesc"></a>

	</div>

</body>
</html>