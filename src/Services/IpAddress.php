<?php
namespace Agustingomes\GeoLocation\Services;

/**
 * This class handles the determination of the client's IP
 */
class IpAddress
{	
	/**
	 * The IP Address to be set by the functions of this class.
	 * @var string
	 */
	private $ipAddress;

	/**
	 * When the class is created, there are 3 ways to set up the initial IP:
	 * - Receiving it in the parameter $ipAddress.
	 * - Retrieving it from the server variable $_SERVER['REMOTE_ADDR'].
	 * - using an external API to retrieve the IP Address of origin of the request.
	 * @param string
	 */
	public function __construct($ipAddress = '') 
	{
		if(!$this->setIpAddress($ipAddress)) {
			if (array_key_exists('REMOTE_ADDR', $_SERVER) === true) {
				if(!$this->setIpAddress($_SERVER['REMOTE_ADDR'])) {
					$this->getClientIpFromExternalApi();								
				}								
			} else {
				$this->getClientIpFromExternalApi();
			}
		}
	}
	/**
	 * Retrieves the IP of origin of the API request.
	 * @return string
	 */
	private function getClientIpFromExternalApi() 
	{
		$ipInfo = json_decode(file_get_contents('http://ipinfo.io/json'), true);
		return $this->setIpAddress($ipInfo['ip']);
	}	

	/**
	 * Verifies if the IP Address is valid, if this is the case, sets the IP Address from the $inputIp parameter.
	 * @param string
	 * @return bool
	 */
	public function setIpAddress($inputIp = '') 
	{		
		if(!filter_var($inputIp, FILTER_VALIDATE_IP) === false){	
			$this->ipAddress = $inputIp;
			return true;
		}
		return false;
	}

	/**
	 * Retrieves the IP of origin of the API request.
	 * @return string
	 */
	public function getIpAddress() 
	{
		return $this->ipAddress;
	}
}