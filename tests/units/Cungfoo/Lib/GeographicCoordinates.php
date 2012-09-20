<?php
namespace tests\units\Cungfoo\Lib;

require_once __DIR__.'/../../../bootstrap.php';

use mageekguy\atoum;

use Cungfoo\Lib\GeographicCoordinates as TestedClass,
    Cungfoo\Lib\Adapter\Test\Adapter;

class GeographicCoordinates extends atoum\test
{
    public function test__construct()
    {
        $this
            ->if($adapter = new Adapter())
            ->and($adapter->{'extension_loaded'} = true)
            ->then
                ->object(new TestedClass($adapter))->isInstanceOf('\\Cungfoo\\Lib\\GeographicCoordinates')
            ->if($adapter->{'extension_loaded'} = false)
            ->then
                ->exception(
                    function() use($adapter) {
                        new TestedClass($adapter);
                    }
                )
                    ->isInstanceOf('\\RuntimeException')
                    ->hasMessage('GEOIP extension is not loaded')
        ;
    }

    public function testgetAddressByIp()
    {
        $this->mockGenerator->generate('\Cungfoo\Lib\Adapter\Test\Adapter');

        $this
            ->if($adapter = new \mock\Cungfoo\Lib\Adapter\Test\Adapter())
            ->and($adapter->{'extension_loaded'} = true)
            ->and($adapter->{'geoip_record_by_name'} = array())
            ->and($testedClass = new TestedClass($adapter))
            ->then
                ->string($testedClass->getAddressByIp('1'))
                ->isEqualTo('')
            ->if($adapter->{'geoip_record_by_name'} = array('city' => 'Lyon'))
            ->then
                ->string($testedClass->getAddressByIp('2'))
                ->isEqualTo('Lyon')
            ->if($adapter->{'geoip_record_by_name'} = array('city' => 'Lyon', 'country_name' => 'France'))
            ->then
                ->string($testedClass->getAddressByIp('3'))
                ->isEqualTo('Lyon,France')
            ->if($adapter->{'geoip_record_by_name'} = array('country_name' => 'France'))
            ->then
                ->string($testedClass->getAddressByIp('4'))
                ->isEqualTo('France')
        ;
    }

    public function testgetGeographicCoordinatesByIp()
    {
        $this->mockGenerator->generate('\Cungfoo\Lib\Adapter\Test\Adapter');

        $this
            ->if($adapter = new \mock\Cungfoo\Lib\Adapter\Test\Adapter())
            ->and($adapter->{'extension_loaded'} = true)
            ->and($adapter->{'geoip_record_by_name'} = array(''))
            ->and($testedClass = new TestedClass($adapter))
            ->then
                ->array($testedClass->getGeographicCoordinatesByIp('1'))
                ->isEqualTo(array('lat' => '', 'lng' => ''))
            ->if($adapter->{'geoip_record_by_name'} = array('latitude' => '32'))
            ->then
                ->array($testedClass->getGeographicCoordinatesByIp('2'))
                ->isEqualTo(array('lat' => '32', 'lng' => ''))
            ->if($adapter->{'geoip_record_by_name'} = array('longitude' => '33'))
            ->then
                ->array($testedClass->getGeographicCoordinatesByIp('3'))
                ->isEqualTo(array('lat' => '', 'lng' => '33'))
            ->if($adapter->{'geoip_record_by_name'} = array('latitude' => '32', 'longitude' => '33'))
            ->then
                ->array($testedClass->getGeographicCoordinatesByIp('4'))
                ->isEqualTo(array('lat' => '32', 'lng' => '33'))
        ;
    }
}
