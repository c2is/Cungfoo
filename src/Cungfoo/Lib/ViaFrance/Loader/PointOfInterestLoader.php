<?php

namespace Cungfoo\Lib\ViaFrance\Loader;

use Cungfoo\Model\PointInteret,
    Cungfoo\Model\PointInteretQuery,
    Cungfoo\Model\EtablissementPointInteret,
    Cungfoo\Model\EtablissementPointInteretQuery,
    Cungfoo\Model\RegionPointInteret,
    Cungfoo\Model\RegionPointInteretQuery;

class PointOfInterestLoader extends AbstractLoader
{
    protected $cache = array();

    protected $processedIds = array();

    public function init($con)
    {
        parent::init($con);

        $this->cache = array();

        $this->dbConnection->exec("SET FOREIGN_KEY_CHECKS = 0");
    }

    public function close()
    {
        $pois = PointInteretQuery::create()->select('id')->find()->toArray();
        $toDelete = array_diff($pois, $this->processedIds);

        PointInteretQuery::create()
            ->filterById($toDelete)
            ->delete()
        ;

        $this->dbConnection->exec("SET FOREIGN_KEY_CHECKS = 1");
    }

    public function load($etab, $data, $language)
    {
        $xml   = new \SimpleXMLElement($data);
        $cache = array();

        foreach ($xml->{'Place'} as $place)
        {
            if ($poi = $this->insertPointInteret($place, $language))
            {
                if (!in_array($poi->getId(), $this->processedIds))
                {
                    $this->processedIds[] = $poi->getId();
                }
                if ($language == 'de')
                {
                    $this->insertRegionRelation($etab, $poi);
                }
                else
                {
                    $this->insertRelation($etab, $poi, $place['DistanceXY']);
                }
            }
        }
    }

    public function insertPointInteret($place, $language)
    {
        $code = (string) $place['Id'];

        if (isset($this->cache[$code][$language]))
        {
            return $this->cache[$code][$language];
        }

        $utils = new \Cungfoo\Lib\Utils();

        $poi = PointInteretQuery::create()
            ->filterByCode($code)
            ->findOne($this->dbConnection);
        ;

        if (!$poi)
        {
            $poi = new PointInteret();
        }

        $poi
            ->setLocale($language)
            ->setName($place->{'Name'})
            ->setSlug($utils->slugify($place->{'Name'}))
            ->setCode($code)
            ->setAddress($place->{'Address'})
            ->setAddress2($place->{'Address2'})
            ->setZipcode($place->{'ZipCode'})
            ->setCity($place->{'City'})
            ->setGeoCoordinateX($place->attributes()->{'X'})
            ->setGeoCoordinateY($place->attributes()->{'Y'})
            ->setDistanceCamping($place->attributes()->{'DistanceXY'})
            ->setImage($place->{'Image'})
            ->setPresentation($place->{'Presentation'})
            ->setTel($place->{'Tel'})
            ->setFax($place->{'Fax'})
            ->setEmail($place->{'Email'})
            ->setWebsite($place->{'WebSite'})
            ->setTransport($place->{'Transports'})
            ->setCategorie($place->{'SubCategorySet'}->{'SubCategory'})
            ->setType($place->{'SubCategorySet'}->{'SubCategory'}[1])
        ;

        $poi->save($this->dbConnection);

        $this->cache[$code][$language] = $poi;

        return $poi;
    }

    public function insertRelation($etab, $poi, $distance)
    {
        $etabPoi = EtablissementPointInteretQuery::create()
            ->filterByEtablissementId($etab->getId())
            ->filterByPointInteretId($poi->getId())
            ->findOne($this->dbConnection)
        ;

        if (!$etabPoi)
        {
            $etabPoi = new EtablissementPointInteret();
            $etabPoi
                ->setEtablissementId($etab->getId())
                ->setPointInteretId($poi->getId())
                ->setDistance($distance)
                ->save($this->dbConnection)
            ;
        }
    }

    public function insertRegionRelation($region, $poi)
    {
        $regionPointInteret = RegionPointInteretQuery::create()
            ->filterByRegionId($region->getId())
            ->filterByPointInteretId($poi->getId())
            ->findOne($this->dbConnection)
        ;

        if (!$regionPointInteret)
        {
            $regionPointInteret = new RegionPointInteret();
            $regionPointInteret
                ->setRegionId($region->getId())
                ->setPointInteretId($poi->getId())
                ->save($this->dbConnection)
            ;
        }
    }
}
