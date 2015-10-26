<?php
use Agustingomes\GeoLocation\Factories\ProviderFactory;

class ProviderFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if the ProviderFactory class returns the expected object, given the service identifier passed
     *    
     * @dataProvider factoriesProvider
     */
    public function testDefaultProvider($factory, $instance)
    {
        $this->assertInstanceOf($instance, $factory->getProvider());
    }

    public function factoriesProvider()
    {
        return [
            [new ProviderFactory(), 'Agustingomes\GeoLocation\Providers\Geobytes'],
            [new ProviderFactory('geobytes'), 'Agustingomes\GeoLocation\Providers\Geobytes'],
            [new ProviderFactory('ip-api'), 'Agustingomes\GeoLocation\Providers\IpApi'],   
            [new ProviderFactory('invalid-provider'), 'Agustingomes\GeoLocation\Providers\Geobytes']       
        ];
    }
}