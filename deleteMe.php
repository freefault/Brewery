<?php

namespace Brewery;


class BeerPrinter
{

	public function getBeerListHTML($beerList)

	{
		$header = '<ul>';
		$body = '';
		foreach ($beerList as $beerObject)
		{
			$body .= $this->printSingleBeer($beerObject);
		}

		$footer = '</ul>';

		return $header . $body . $footer;
	}


	private function printSingleBeer($beerObject)

	{
		$beer = '<li>';
		$beer .=

		"<div class ='singlebeer'>
		<h1 class='singleBeerTitle'>{$beerObject->name}
		</h1>

		<img alt='{$beerObject->name}' src='{$beerObject->labels->medium}' class = 'singleBeerImage'/>

		<p class = 'singleBeerDescription'>{$beerObject->description}
		</p>
		</div>";
		$beer .= '</li>';
		return $beer;
	}
}