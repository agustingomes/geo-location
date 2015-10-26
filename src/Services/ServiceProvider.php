<?php
namespace Agustingomes\GeoLocation\Services;

use Agustingomes\GeoLocation\Services\IpAddress;
/**
 * This is the abstract class that manages the data coming from the given provider.
 * New providers added to the library, must extend this class.
 */
abstract class ServiceProvider 
{	
	/**
	 * IP Placeholder to add to $apiUrl.
	 * @var string
	 */
	static $ipPlaceholder = '{{ip-address}}';

	/**
	 * The API URL to be used for the data request.
	 * @var string
	 */
	private $apiUrl;

	/**
	 * The Provider Name
	 * @var string
	 */
	private $providerName;

	/**
	 * Object that will execute functions to set the IP Address present in the data retrieval from the external API.
	 * @var IpAddress
	 */
	private $ipAddress;

	/**
	 * The mappings from the external API fields to the internal field names will be here.
	 * @var array
	 */
	private $fieldMappings;

	/**
	 * The requested fields will be stored here.
	 * @var array
	 */
	private $returnFields = array();	

	/**
	 * Sets the field mappings from our internal fields, to the external API. These values come from the provider class extending this class.
	 * @param array
	 */
	protected function setFieldMappings($keyMaps) 
	{
		$this->fieldMappings = $keyMaps;
	}
	
	/**
	 * Sets the API URL for the data request, from the provider class extending this class.
	 * @param string
	 */
	protected function setApiUrl($apiUrl)
	{
		$this->apiUrl = $apiUrl;
	}

	/**
	 * Sets the Provider name, from the provider class extending this class.
	 * @param string
	 */
	protected function setProviderName($providerName)
	{
		$this->providerName = $providerName;
	}

	/**
	 * Gets the Provider name.
	 * @return string
	 */
	public function getProviderName() 
	{
		return $this->providerName;
	}	

	/**
	 * Gets the current IP Address within our IpAddress class.
	 * @return string
	 */
	public function getClientIpAddress() 
	{
		return $this->ipAddress->getIpAddress();
	}

	/**
	 * Sets the IpAddress we're going to work with.
	 * @param IpAddress
	 */
	public function setClientIp(IpAddress $ipAddress) 
	{
		$this->ipAddress = $ipAddress;
	}

	/**
	 * Sets the single fields to return data.
	 * @param string
	 */
	public function setFieldsToRetrieve($fieldName) 
	{
		if (array_key_exists($fieldName, $this->returnFields) === false) {
			$this->returnFields[$fieldName] = '';
		}
	}

	/**
	 * Sets all the available fields for the given provider, to receive data from the API.	 
	 */
	public function fetchAllFields() 
	{
		foreach($this->fieldMappings as $internalKey => $apiKey) {
			$this->setFieldsToRetrieve($internalKey);
		}
	}

	/**
	 * Returns the fetched data in the given format (default is array).
	 * @param string
	 * @return mixed (JSON, array)
	 */
	public function getFetchedData($format = '') 
	{
		$this->getInformationFromProvider();
		switch($format) {
			case 'json':							
				return json_encode($this->returnFields);	
				break;

			default:
				return $this->returnFields; 	
				break;
		}		
	}

	/**
	 * Executes the data retrieval from the external API.
	 * The results from the external API are read, and the individual values are assigned to the array $returnFields, on the key present in the $fieldMappings array. in case there's no mapping for the field to be returned, it will stay with blanks.
	 * @param string
	 * @return mixed (JSON, array)
	 */
	public function getInformationFromProvider()
	{	
		$apiInfo = file_get_contents(str_replace(self::$ipPlaceholder, $this->ipAddress->getIpAddress(), $this->apiUrl), true);
		if($apiInfo !== false) {
			$decodedApiInfo = json_decode($apiInfo, true);
			foreach($this->returnFields as $valueKey => $keyValue) {				
				if (array_key_exists($valueKey, $this->fieldMappings) === true) {
					$keyFromApi = $this->fieldMappings[$valueKey];
					if (array_key_exists($keyFromApi, $decodedApiInfo) === true) {
						$this->returnFields[$valueKey] = $decodedApiInfo[$keyFromApi];	
					}	
				}
			}		
		}
	}
}