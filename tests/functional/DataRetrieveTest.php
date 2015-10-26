<?php
use Agustingomes\GeoLocation\Services\GeoLocator;

class DataRetrieveTest extends PHPUnit_Framework_TestCase
{
    /**
     * Tests if the required fields are retrieved
     *    
     * @dataProvider getRequiredFieldsProvider
     */ 
    public function testDefaultFieldsOfProviders($geoLocator, $requiredKeys)
    {
        $fetchedInfo = $geoLocator->fetchInfo();
        foreach($requiredKeys as $currentKey) {
            $this->assertArrayHasKey($currentKey, $fetchedInfo);
        }
    }

    public function getRequiredFieldsProvider()
    {
        return [
            [new GeoLocator('geobytes'), ['country-name', 'country-code']],
            [new GeoLocator('ip-api'), ['country-name', 'country-code']]
        ];
    }

    /**
     * Tests if the optional fields given are retrieved
     *    
     * @dataProvider getOptionalFieldsProvider
     */ 
    public function testOptionalFieldsOfProviders($geoLocator, $optionalKeys)
    {
        $geoLocator->getInfoFromField($optionalKeys);           
        $fetchedInfo = $geoLocator->fetchInfo();
        foreach($optionalKeys as $currentKey) {
            $this->assertArrayHasKey($currentKey, $fetchedInfo);
        }
    }

    /**
     * Tests if the JSON response is valid
     *
     * @dataProvider getOptionalFieldsProvider
     */
    public function testJSONResponse($geoLocator, $optionalKeys)
    {
        foreach($optionalKeys as $currentKey) {
            $geoLocator->getInfoFromField($currentKey);   
        }
        $fetchedInfo = $geoLocator->fetchInfo('json');
        $decodedData = json_decode($fetchedInfo);

        $this->assertEquals(false, json_last_error());
    }

    public function getOptionalFieldsProvider()
    {
        return [
            [new GeoLocator('geobytes'), ['currency-code', 'postal-code', 'invalid-field']],
            [new GeoLocator('ip-api'), ['currency-code', 'postal-code', 'invalid-field']]
        ];
    } 
}