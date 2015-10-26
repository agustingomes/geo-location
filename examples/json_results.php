<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Agustingomes\GeoLocation\Services\GeoLocator;

$geoLocator = new GeoLocator('geobytes');
$geoLocator
	->getInfoFromField('region-name')
	->getInfoFromField('region-code')
	->getInfoFromField('internet-provider');	
header('Content-Type: application/json');
echo $geoLocator->fetchInfo('json');