<?php

namespace Cungfoo\Lib\Resalys\Loader;

use Cungfoo\Lib\Resalys\Loader\BaseLoader,
    Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\Etablissement;

class getFlowProposalsLoader extends BaseLoader
{
    public function load($data, $locale, \PropelPDO $con)
    {
        foreach ($data->etabListFlowProposals as $items)
        {
            foreach ($items as $etablissement)
            {
                $objectEtab = EtablissementQuery::create()
                    ->filterByCode($etablissement->{'etab_id'})
                    ->findOne($con)
                ;

                if ($objectEtab)
                {
                    $objectEtab
                        ->setMinimumPrice($etablissement->{'minimum_net_price'})
                        ->save($con)
                    ;
                }
            }
        }
    }
}