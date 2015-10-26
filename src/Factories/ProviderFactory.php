<?php
namespace Agustingomes\GeoLocation\Factories;

use Agustingomes\GeoLocation\Providers\Geobytes;
use Agustingomes\GeoLocation\Providers\IpApi;

/**
 * This class creates the required instance of the provider required
 */
class ProviderFactory
{	
	/**
	 * Code of the requested provider.
	 * @var string
	 */
	private $providerCode;

	public function __construct($providerCode = '')
	{		
		$this->providerCode = $providerCode;
	}

	/**
	 * Returns the provider for the given $providerCode
	 * @return Object
	 */
	public function getProvider() 
	{
		switch($this->providerCode) {
			case 'geobytes':
			default:
				return new Geobytes();
				break;

			case 'ip-api':
				return new IpApi();
				break;

		}
	}
}