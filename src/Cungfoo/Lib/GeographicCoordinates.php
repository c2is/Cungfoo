<?php

namespace Cungfoo\Lib;

use Cungfoo\Lib\Adapter\AdapterInterface;
use Cungfoo\Lib\Adapter\Adapter;

class GeographicCoordinates
{
    private $adapter;

    private $records = array();

    public function __construct(AdapterInterface $adapter = null)
    {
        $this->setAdapter($adapter);

        if (false === $this->getAdapter()->extension_loaded('geoip'))
        {
            throw new \RuntimeException('GEOIP extension is not loaded');
        }
    }

    public function setAdapter(AdapterInterface $adapter = null)
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function getAdapter()
    {
        if (null === $this->adapter)
        {
            $this->adapter = new Adapter();
        }

        return $this->adapter;
    }

    public function getRecordByIp($ip)
    {
        if (!array_key_exists($ip, $this->records))
        {
            try
            {
                $this->records[$ip] = $this->getAdapter()->geoip_record_by_name($ip);
            }
            catch (\Exception $exception)
            {
                $this->records[$ip] = array();
            }
        }

        return $this->records[$ip];
    }

    /**
     * @static
     *
     * @param string $ip
     * @return string
     */
    public function getAddressByIp($ip)
    {

        $geoip      = $this->getRecordByIp($ip);
        $address    =  sprintf('%s,%s',
            isset($geoip['city']) ? $geoip['city'] : '',
            isset($geoip['country_name']) ? $geoip['country_name'] : ''
        );

        return trim($address, ',');
    }

    /**
     * @static
     *
     * @param string $ip
     * @return array
     */
    public function getGeographicCoordinatesByIp($ip)
    {
        $geoip      = $this->getRecordByIp($ip);

        return array(
            'lat' => isset($geoip['latitude']) ? $geoip['latitude'] : '',
            'lng' => isset($geoip['longitude']) ? $geoip['longitude'] : ''
        );
    }
}
