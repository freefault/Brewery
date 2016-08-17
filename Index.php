<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
			<title>Distilled SCH Beer Application</title>
			
	</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script>

	
    $(document).ready(function(){
    $('#randomButton').click(function() {
        randomize();
    });

        //the first one
        randomize();
    });



    function randomize()
    {
        $.ajax({
            url: "BreweryConnector.php?action=random",
            dataType: 'jsonp',
            success: function (result) {
                $("#errorText").hide();
                console.log(result);
            },
            error: function (result) {
                console.log(result);
                $("#errorText").html('An Error Occurred');
                $("#errorText").show();
            }
        });
        $("#randomText").html("Hello World " + Math.random());

    }

    </script>
    <body>

    <div>

     <div id = 'errorText'>
            </div>
    <div id = 'randomText'>

    	</div>
        
        <div>
            <button id="randomButton" class="ui-button ui-widget ui-corner-all">Randomise</button>
        </div>
    </div>


    </body>
</html>