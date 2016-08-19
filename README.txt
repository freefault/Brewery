Environment Setup:
Initially I lost a lot of time trying to get all of the necessary elements needed for a PHP project installed.
I wanted to be able to use cURL when connecting to the API, however I couldn't get this or PHPUnit to work in my windows environment.

Project Setup:
I tried to stick to a PHP package structure when creating the project, based off the example I found at http://culttt.com/2014/05/07/create-psr-4-php-package/.
Keeping any PHP classes created by me in an SRC folder and any tests in a Tests folder.

BreweryConnector.php
BreweryConnector Class
This class is to be used to connect to the API, with specific function depending 
on the request type (e.g. random beer, brewery search by id)
These functions then return a formatted version of the API response

function getKey()
The API key is hard coded in the class, in a real world scenario this should be called 
from a separate place and not hardcoded in the class.

ajax.php
This page is work as a midpoint between the jquery requests in Index.php and the API 
calls in BreweryConnector object this page instantiates. It then echos the API response back to Index.php

Index.php
This is the display page for the project. It is a combination of JQuery and HTML. 
The first section displays a random beer returned by the API. 
This is done through JQuery so it allows for the fields to be updated when 
the “Another Beer“ button is clicked and another random beer is returned without having to reload the page.
JQuery is used for the “More From this Brewery” button, it iterates through the array of beers 
returned by the Search result and adds each on to the searchedBeerDetails div. 

Ideally I would have preferred to have included a htmlFormater class in 
PHP which would format the BreweryConnector function returns into HTML, rather than have this done on the page.


TO DO:
Doing the project in PHP meant I was working slower than I would like, 
so I was unable to get the full set of requirements finished.

-	Styling
I didn’t leave myself enough time to apply any styling or formatting across the page. 
The search results are being displayed on screen, however they are not as neat as I would like them to be.

-	Free Text search
For this I would have taken the entered text from the textbox, along with the selected radio 
button (beer or brewery), passed these through to ajax.php as parameters. ajax.php would have a “search” case.
The search case would then trigger a new connector, which would then call a search function. 
The search function would call the API, format the responses and return these. 
The search results would then be passed back to index.php. 

-	Tests
I was unable to get PHPUnit running in my local environment, so I could not include a full suite of tests. 
I would have expanded my tests out to test each function within the breweryConnector class.

-	Validation
With the free text search I would validate the input string for using the strpbrk function, 
if the non specified characters are included I would then throw an exception. 
Otherwise the string should be allow to be used in the search query.
