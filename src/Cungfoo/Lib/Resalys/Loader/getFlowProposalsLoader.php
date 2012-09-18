<?php

namespace Cungfoo\Lib\Resalys\Loader;

use Cungfoo\Lib\Resalys\Loader\BaseLoader,
    Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\Etablissement;

class getFlowProposalsLoader extends BaseLoader
{
    public function load($data, $locale, \PropelPDO $con)
    {
        foreach ($data as $etablissement)
        {
            foreach ($etablissement as $minimalPrice)
            {
                $objectEtab = EtablissementQuery::create()
                    ->filterByCode($minimalPrice->{'etab_id'})
                    ->findOne($con)
                ;

                if ($objectEtab)
                {
                    $objectEtab
                        ->setMinimumPrice($minimalPrice->{'minimum_net_price'})
                        ->save($con)
                    ;
                }
            }
        }
    }
}