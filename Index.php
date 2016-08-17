<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
			<title>Distilled SCH Beer Application</title>
			
	</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
            url: "BreweryConnector.php?action=randomBeer",
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

                
                url: "BreweryConnector.php?action=breweryBeers",
                data: {brewerID : $("#breweryID").text()},
                success: function (result) {
                    $("#errorText").hide();
                    console.log(result);
                    var parsedResult = JSON.parse(result);
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

     <div id = "errorText">
            </div>
    <div id = "beerDetails">
    	
    	<h1 id="beerName"></h1>
    	<img alt="" src="" id="beerLabel"></img>
    	<a id="beerDesc"></a>
    	<p id="breweryID"></p>
    
    </div>
    
        
        <div>
            <button id="randomButton" class="ui-button ui-widget ui-corner-all">Another Beer</button>
            <button id="moreFromBrewery" class="ui-button ui-widget ui-corner-all">More From this Brewery</button>
        </div>
    </div>


    </body>
</html>