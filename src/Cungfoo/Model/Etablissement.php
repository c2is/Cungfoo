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

    public function getDmsCoordinates()
    {
        $utils = new \Cungfoo\Lib\Utils();

        return $utils->decimalToDms((float)$this->getGeoCoordinateX(), (float)$this->getGeoCoordinateY());
    }

    public function getCategoriesTypeHergement()
    {
        return \Cungfoo\Model\CategoryTypeHebergementQuery::create()
            ->joinWithI18n()
            ->useTypeHebergementQuery()
                ->useEtablissementTypeHebergementQuery()
                    ->filterByEtablissementId($this->getId())
                ->endUse()
            ->endUse()
            ->distinct()
            ->find()
        ;
    }

    public function getCapacitesTypeHebergement()
    {
        return \Cungfoo\Model\TypeHebergementQuery::create()
            ->select('NombrePlace')
            ->joinWithI18n()
            ->useEtablissementTypeHebergementQuery()
                ->filterByEtablissementId($this->getId())
            ->endUse()
            ->distinct()
            ->find()
        ;
    }

    public function getMinimumPrice()
    {
        $minimalPrice = 9999;

        foreach($this->getEtablissementTypeHebergements() as $type)
        {
            $min = $type->getMinimumPrice();

            if( $min != '')
            {
                if(is_numeric($min))
                {
                    if($min < $minimalPrice)
                    {
                        $minimalPrice = $min;
                    }
                }
            }
        }

        return $minimalPrice;
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

}
