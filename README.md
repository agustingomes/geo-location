Agustin Gomes - Geo Location library for PHP
===========================================

##  DESCRIPTION

This library simplifies the process of the GeoLocation, and allows you, with few lines of code, to get the information you need about the location according to a given IP Address.

##  USING THE LIBRARY
    
Download the composer.phar to the root of the library, and install it's dependencies

    curl -sS https://getcomposer.org/installer | php
    php composer.phar install
    
    php examples/array_results.php

or add it to your project by adding these lines to the file composer.json
    
    "require": {
      "agustingomes/geo-location": "dev-master"
    }

and update the project via composer
  
    php composer.phar update
        
   

##  GETTING STARTED

to use the library within your project, simply add

    use Agustingomes\GeoLocation\Services\GeoLocator;
    
    function yourFunction() 
    {
      $geoLocator = new GeoLocator();
      $info = $geoLocator->fetchInfo();
      /* handle the returned result in array format */
    }

This will create the class with the Geobytes service provider by default. If you want to specify another service provider, you can pass the provider code in the first parameter:

    $geoLocator = new GeoLocator('ip-api');

Currently, there is only 2 providers, Geobytes('geobytes') or IP API('ip-api').

The class will return by default 2 fields: the country name('country-name') and the country code('country-code'). You can get more fields in 2 ways.

You can request all the fields available from the provider:

    $geoLocator->getAllFieldsAvailable();

... or you can add specific fields:

    $geoLocator
	    ->getInfoFromField('region-name')
	    ->getInfoFromField('region-code')
	    ->getInfoFromField('internet-provider');

Here is a list of the fields available for the Geobytes:

		'country-name'
		'country-code'
		'region-name'
		'region-code'
		'city-name'
		'latitude'
		'longitude'
		'timezone'
		'queried-ip'
		'forwarded-for'
		'remote-ip'
		'api-certainty'
		'location-code'
		'location-code-ext'
		'city-id'
		'full-qualif-name'
		'country-capital'
		'nationality-sing'
		'nationality-plur'
		'population'
		'map-reference'
		'currency-name'
		'currency-code'
		'title'

Here is a list of the fields available for the IP API:

		'country-name'
		'country-code'
		'region-name'
		'region-code'
		'city-name'
		'latitude'
		'longitude'
		'timezone'
		'queried-ip'
		'internet-provider'
		'organization-name'
		'organization-full'
		'status'
		'postal-code'

In case you use any field not present in the library, it's value will be set to blanks.

The library returns the information in an array by default, but if you prefer, you can receive the data in JSON format, you just need to specify it when you call the fetchInfo function:

    $infoJson = $geoLocator->fetchInfo('json');

## RUN UNIT TESTS

To run unit tests, run this comand from your project root:

    php vendor/phpunit/phpunit/phpunit vendor/agustingomes/geo-location/tests/

if you are using this library stand alone, the command to run would be:

    php vendor/phpunit/phpunit/phpunit tests/

