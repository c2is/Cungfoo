<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseEtablissementPeer;


/**
 * Skeleton subclass for performing query and update operations on the 'etablissement' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class EtablissementPeer extends BaseEtablissementPeer
{
    public static function getNameOrderByName(\PropelPDO $con = null)
    {
        return \Cungfoo\Model\EtablissementQuery::create()
            ->orderByName()
            ->select(array('Id', 'Name'))
            ->find($con)
        ;
    }

    public static function getNameOrderByVille($locale = BaseEtablissementPeer::DEFAULT_LOCALE, \PropelPDO $con = null)
    {
        return \Cungfoo\Model\EtablissementQuery::create()
            ->leftJoinVille()
            ->useVilleQuery()
                ->leftJoinVilleI18n()
                ->useVilleI18nQuery()
                    ->filterByLocale($locale)
                    ->orderByName()
                ->endUse()
                ->leftJoinRegion()
                ->useRegionQuery()
                    ->useRegionI18nQuery()
                        ->filterByLocale($locale)
                        ->orderByName()
                    ->endUse()
                ->endUse()
            ->endUse()
            ->select(array('Id', 'RegionI18n.Name', 'VilleI18n.Name', 'Name'))
            ->find($con)
        ;
    }
}
