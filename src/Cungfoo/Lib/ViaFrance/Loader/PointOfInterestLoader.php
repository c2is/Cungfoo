<?php

namespace Cungfoo\Lib\ViaFrance\Loader;

use Cungfoo\Model\PointInteret,
    Cungfoo\Model\PointInteretQuery,
    Cungfoo\Model\EtablissementPointInteret,
    Cungfoo\Model\EtablissementPointInteretQuery;

class PointOfInterestLoader extends AbstractLoader
{
    protected $cache = array();

    public function init($con)
    {
        parent::init($con);

        $this->cache = array();

        $this->dbConnection->exec("SET FOREIGN_KEY_CHECKS = 0");
        $this->dbConnection->exec("TRUNCATE TABLE `etablissement_point_interet`");
        $this->dbConnection->exec("TRUNCATE TABLE `point_interet_i18n`");
        $this->dbConnection->exec("TRUNCATE TABLE `point_interet`");
    }

    public function close()
    {
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
                $this->insertRelation($etab, $poi, $place['DistanceXY']);
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

        $poi = PointInteretQuery::create()
            ->filterByCode($code)
            ->findOne($this->dbConnection);
        ;

        if ($language == 'fr')
        {
            if ($poi)
            {
                return $poi;
            }

            $poi = new PointInteret();
            $poi
                ->setLocale($language)
                ->setName($place->{'Name'})
                ->setCode($code)
                ->setAddress($place->{'Address'})
                ->setAddress2($place->{'Address2'})
                ->setZipcode($place->{'ZipCode'})
                ->setCity($place->{'City'})
                ->setGeoCoordinateX($place->attributes()->{'X'})
                ->setGeoCoordinateY($place->attributes()->{'Y'})
                ->setImage($place->{'Image'})
                ->setPresentation($place->{'Presentation'})
            ;
        }
        else
        {
            if (!$poi)
            {
                return null;
            }

            $defaultName            = $poi->getName();
            $defaultPresentation    = $poi->getPresentation();

            $poi
                ->setLocale($language)
                ->setName(($place->{'Name'}) ? $place->{'Name'} : $defaultName)
                ->setName(($place->{'Presentation'}) ? $place->{'Presentation'} : $defaultPresentation)
            ;
        }

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
}
