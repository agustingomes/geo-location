<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use Agustingomes\GeoLocation\Services\GeoLocator;

$geoLocator = new GeoLocator('ip-api');
$geoLocator	
	->getAllFieldsAvailable();
header('Content-Type: text/html');	
print_r($geoLocator->fetchInfo());