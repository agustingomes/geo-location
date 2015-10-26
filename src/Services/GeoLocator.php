<?php
namespace Agustingomes\GeoLocation\Services;

use Agustingomes\GeoLocation\Factories\ProviderFactory;
use Agustingomes\GeoLocation\Services\IpAddress;

/**
 * This is the only class the user needs to include in order to use the library.
 */
class GeoLocator
{	
	/**
	 * This variable will contain the service provider class, according to the parameters received in the creation of this class.
	 * @var Object
	 */
	private $provider;

	/** 
	 * Receives the variables to initialize the class, by getting the right provider and setting the IP Address.    
     * @param string
     * @param string
     */
	public function __construct($providerCode = '', $ipAddress = '') 
	{
		$factory = new ProviderFactory($providerCode);
		$this->provider = $factory->getProvider();
		$this->provider->setClientIp(new IpAddress($ipAddress));
		$this
			->getInfoFromField('country-name')
			->getInfoFromField('country-code');
	}

	/**
	 * Receives a string or an array, with the fields the library should return.
	 * @param mixed
	 */
	public function getInfoFromField($fieldName) 
	{
		if(is_array($fieldName)) {
			foreach($fieldName as $singleField) {
				$this->provider->setFieldsToRetrieve($singleField);
			}
		} else {
			$this->provider->setFieldsToRetrieve($fieldName);
		}
		return $this;
	}

	/**
	 * Instructs the provider to retrieve all the fields from the API.
	 */
	public function getAllFieldsAvailable()
	{
		$this->provider->fetchAllFields();
	}

	/**
	 * Instructs the provider to retrieve the data from the external API.
	 * @param string
	 */
	public function fetchInfo($format = '') 
	{
		return $this->provider->getFetchedData($format); 			
	}
}