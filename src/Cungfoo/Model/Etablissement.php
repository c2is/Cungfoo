<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseEtablissement;


/**
 * Skeleton subclass for representing a row from the 'etablissement' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class Etablissement extends BaseEtablissement
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getRegion()
    {
        return $this->getVille()->getRegion();
    }

    public function getVignette()
    {
        return parent::getVignette()?: "images/vacancesdirectes/common/images/search-default.jpg";

    }

    public function getPays()
    {
        return $this->getRegion()->getPays();
    }

    public function getDmsCoordinates()
    {
        $utils = new \Cungfoo\Lib\Utils();

        return $utils->decimalToDms((float) $this->getGeoCoordinateX(), (float) $this->getGeoCoordinateY());
    }

    public function getCategoriesTypeHergement()
    {
        return \Cungfoo\Model\CategoryTypeHebergementQuery::create()
            ->useTypeHebergementQuery()
                ->useEtablissementTypeHebergementQuery()
                    ->filterByEtablissementId($this->getId())
                ->endUse()
            ->endUse()
            ->distinct()
            ->findActive()
        ;
    }

    public function getCapacitesTypeHebergement()
    {
        return \Cungfoo\Model\TypeHebergementQuery::create()
            ->select('NombrePlace')
            ->useEtablissementTypeHebergementQuery()
                ->filterByEtablissementId($this->getId())
            ->endUse()
            ->distinct()
            ->findActive()
        ;
    }

    public function getMinimumPrice()
    {
        $minimalPrice = 9999;

        foreach ($this->getEtablissementTypeHebergements() as $type)
        {
            $min = $type->getMinimumPrice();

            if ($min != '')
            {
                if (is_numeric($min))
                {
                    if ($min < $minimalPrice)
                    {
                        $minimalPrice = $min;
                    }
                }
            }
        }

        return $minimalPrice == 9999 ? 0 : $minimalPrice;
    }

    public function getMinimumPriceLabel()
    {
        $minimalPrice = 9999;

        foreach ($this->getEtablissementTypeHebergements() as $type)
        {
            $min = $type->getMinimumPrice();

            if ($min != '')
            {
                if (is_numeric($min))
                {
                    if ($min < $minimalPrice)
                    {
                        $minimalPrice = $min;
                    }
                }
            }
        }

        if ($minimalPrice == 9999)
        {
            return null;
        }

        return \Cungfoo\Model\EtablissementTypeHebergementQuery::create()
             ->select('MinimumPriceDiscountLabel')
             ->filterByEtablissementId($this->getId())
             ->filterByMinimumPrice($minimalPrice)
             ->addAscendingOrderByColumn('minimum_price')
             ->findOne()
         ;
    }

    public function getMinimumPriceType()
    {
        $minimalPrice = 9999;

        foreach ($this->getEtablissementTypeHebergements() as $type)
        {
            $min = $type->getMinimumPrice();

            if ($min != '')
            {
                if (is_numeric($min))
                {
                    if ($min < $minimalPrice)
                    {
                        $minimalPrice = $min;
                    }
                }
            }
        }

        if ($minimalPrice == 9999)
        {
            return null;
        }

        return \Cungfoo\Model\EtablissementTypeHebergementQuery::create()
             ->filterByEtablissementId($this->getId())
             ->filterByMinimumPrice($minimalPrice)
             ->addAscendingOrderByColumn('minimum_price')
             ->findOne()
         ;
    }

    public function getRandomPoi($number)
    {
        return PointInteretPeer::getForEtablissement($this, PointInteretPeer::RANDOM_SORT, $number);
    }

    public function getCountPoi()
    {
        return PointInteretPeer::getCountForEtablissement($this);
    }

    public function getPoiPrioritaire()
    {
        return PointInteretPeer::getForEtablissement($this, PointInteretPeer::RANDOM_SORT, 1);
    }

    public function getRandomEvents($number)
    {
        return EventPeer::getForEtablissement($this, EventPeer::RANDOM_SORT, $number);
    }

    public function getCountActivitesSportives()
    {
        return EventPeer::getCountForEtablissement($this, EventPeer::CATEGORY_SPORTIVE);
    }

    public function getCountEvenementsCulturels()
    {
        return EventPeer::getCountForEtablissement($this, EventPeer::CATEGORY_SPORTIVE, \Criteria::NOT_EQUAL);
    }

    public function getEventPrioritaire()
    {
        return EventPeer::getForEtablissement($this, EventPeer::SORT_BY_PRIORITY, 1);
    }

    public function getSituationGeographique( PropelPDO $con = null)
    {
        $aSituations = array();

        $situations = $this->getSituationGeographiques();
        foreach ($situations as $situation)
        {
            $aSituations[] = $situation->getCode();
        }

        return implode(",", $aSituations);
    }

    public function getBaignade( PropelPDO $con = null)
    {
        $aBaignades = array();

        $baignades = $this->getBaignades();
        foreach ($baignades as $baignade)
        {
            $aBaignades[] = $baignade->getCode();
        }

        return implode(",", $aBaignades);
    }

    public function getActivite( PropelPDO $con = null)
    {
        $aActivites = array();

        $activites = $this->getActivites();
        foreach ($activites as $activite)
        {
            $aActivites[] = $activite->getCode();
        }

        return implode(",", $aActivites);
    }

    public function getService( PropelPDO $con = null)
    {
        $aServices = array();

        $services = $this->getServiceComplementaires();
        foreach ($services as $service)
        {
            $aServices[] = $service->getCode();
        }

        return implode(",", $aServices);
    }

    public function getThematique( PropelPDO $con = null)
    {
        $aThematiques = array();

        $thematiques = $this->getThematiques();
        foreach ($thematiques as $thematique)
        {
            $aThematiques[] = $thematique->getCode();
        }

        return implode(",", $aThematiques);
    }
}
