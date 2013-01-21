<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseTheme;


/**
 * Skeleton subclass for representing a row from the 'theme' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class Theme extends BaseTheme
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getEtablissementsCatalogues()
    {
        $etab = EtablissementQuery::create()
            ->distinct()
            ->useEtablissementBaignadeQuery(null, \Criteria::RIGHT_JOIN)
                ->filterByBaignade($this->getBaignades())
            ->endUse()
            ->_or()
            ->useEtablissementServiceComplementaireQuery(null, \Criteria::RIGHT_JOIN)
                ->filterByServiceComplementaire($this->getServiceComplementaires())
            ->endUse()
            ->_or()
            ->useEtablissementActiviteQuery(null, \Criteria::RIGHT_JOIN)
                ->filterByActivite($this->getActivites())
            ->endUse()
            ->addAscendingOrderByColumn('RAND()')
            ->_and()
            ->findActive()
        ;

        return $etab;
    }
}
