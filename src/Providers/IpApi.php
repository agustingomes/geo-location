<?php
namespace Agustingomes\GeoLocation\Providers;

use Agustingomes\GeoLocation\Services\ServiceProvider;

/**
 * This class represents the IP-API provider, and extends the functions of the base class. It is constructed, according the specific parameters of the provider.
 */
class IpApi extends ServiceProvider
{	
	public function __construct()
	{
		$this->setProviderName('IP-API');
		$this->setApiUrl('http://ip-api.com/json/' . self::$ipPlaceholder);
		$this->setFieldMappings([
			'country-name' 		=> 'country',
			'country-code' 		=> 'countryCode',
			'region-name' 		=> 'regionName',
			'region-code'		=> 'region',
			'city-name'			=> 'city',
			'latitude'			=> 'lat',
			'longitude'			=> 'lon',
			'timezone'			=> 'timezone',
			'queried-ip'		=> 'query',
			'internet-provider' => 'isp',
			'organization-name'	=> 'org',
			'organization-full'	=> 'as',		
			'status'			=> 'status',			
			'postal-code'		=> 'zip'
		]);
	}	
}