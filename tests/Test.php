<?php

require_once 'src/BreweryConnector.php';

class Test extends PHPUnit_Framework_TestCase {
  public function testGetRandomBeer()  {
    $connector = new BreweryConnector();
    $randomBeer = $connector->getRndmBeer();

    $randomBeer = json_decode($randomBeer);
    $this->assertObjectHasAttribute('name', $randomBeer);
    $this->assertObjectHasAttribute('label', $randomBeer);
    $this->assertObjectHasAttribute('description', $randomBeer);
    $this->assertObjectHasAttribute('breweryId', $randomBeer);
  }
}