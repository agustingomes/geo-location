<?php
use Agustingomes\GeoLocation\Services\IpAddress;

class IpAddressTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if IpAddress class can set the ip address from the value given by the user.
     * This is the first way the class has to set the ip address.     
     */    
    public function testIpFromUserDefinition()
    {
        $ip = new IpAddress('8.8.8.8');
        $this->assertEquals('8.8.8.8', $ip->getIpAddress());
    }

    /**
     * Tests if IpAddress class can set the ip address from an internal network IP Address    
     */    
    public function testInternalNetworkIpDefinition()
    {
        $_SERVER['REMOTE_ADDR'] = '192.168.1.1';
        $ip = new IpAddress();
        $this->assertNotEquals($_SERVER['REMOTE_ADDR'], $ip->getIpAddress());
    }

    /**
     * Tests if IpAddress class can set the ip address from the value of the variable $_SERVER['REMOTE_ADDR'].
     * This is the second way the class has to set the ip address.     
     */
    public function testIpFromServerVar()
    {
        $_SERVER['REMOTE_ADDR'] = '8.8.8.8';
        $ip = new IpAddress();
        $this->assertEquals($_SERVER['REMOTE_ADDR'], $ip->getIpAddress());
    }

    /**
     * Tests if IpAddress class can set the ip address from the value of an external API.
     * This is the third and last way the class has to set the ip address.     
     */
    public function testIpFromExternalAPI()
    {
        $ip = new IpAddress();
        $this->assertNotEquals('', $ip->getIpAddress());
    }
}