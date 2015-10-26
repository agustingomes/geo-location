<?php
namespace Agustingomes\GeoLocation\Providers;

use Agustingomes\GeoLocation\Services\ServiceProvider;

/**
 * This class represents the Geobytes provider, and extends the functions of the base class. It is constructed, according the specific parameters of the provider.
 */
class Geobytes extends ServiceProvider
{	
	public function __construct()
	{
		$this->setProviderName('Geobytes');		
		$this->setApiUrl('http://getcitydetails.geobytes.com/GetCityDetails?fqcn=' . self::$ipPlaceholder);
		$this->setFieldMappings([
			'country-name' 		=> 'geobytescountry',
			'country-code' 		=> 'geobytesinternet',
			'region-name' 		=> 'geobytesregion',
			'region-code'		=> 'geobytescode',
			'city-name' 		=> 'geobytescity',
			'latitude'			=> 'geobyteslatitude',
			'longitude'			=> 'geobyteslongitude',
			'timezone'			=> 'geobytestimezone',
			'queried-ip'		=> 'geobytesipaddress',
			'forwarded-for'		=> 'geobytesforwarderfor',
			'remote-ip'			=> 'geobytesremoteip',
			'api-certainty'		=> 'geobytescertainty',
			'location-code'		=> 'geobytesregionlocationcode',
			'location-code-ext'	=> 'geobyteslocationcode',
			'city-id'			=> 'geobytescityid',
			'full-qualif-name'	=> 'geobytesfqcn',
			'country-capital'	=> 'geobytescapital',
			'nationality-sing'	=> 'geobytesnationalitysingular',
			'nationality-plur'	=> 'geobytesnationalityplural',	
			'population'		=> 'geobytespopulation',
			'map-reference'		=> 'geobytesmapreference',
			'currency-name'		=> 'geobytescurrency',
			'currency-code'		=> 'geobytescurrencycode',
			'title'				=> 'geobytestitle'
		]);
	}	
}