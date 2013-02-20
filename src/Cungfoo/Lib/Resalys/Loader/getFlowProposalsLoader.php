<?php

namespace Cungfoo\Lib\Resalys\Loader;

use Cungfoo\Lib\Resalys\Loader\AbstractLoader,
    Cungfoo\Model\EtablissementTypeHebergementQuery;

class getFlowProposalsLoader extends AbstractLoader
{
    public function load($data, $locale, \PropelPDO $con)
    {
        foreach ($data->etabListFlowProposals->etabListFlowProposal as $etabTypeHeb)
        {
            $objectEtabTypeHeb = EtablissementTypeHebergementQuery::create()
                ->useEtablissementQuery()
                    ->filterByCode($etabTypeHeb->{'etab_id'})
                ->endUse()
                ->useTypeHebergementQuery()
                    ->filterByCode($etabTypeHeb->{'minimum_price_room_type_code'})
                ->endUse()
                ->findOne($con)
            ;

            if ($objectEtabTypeHeb)
            {
                $minimumPrice = property_exists($etabTypeHeb, 'minimum_net_price') ? $etabTypeHeb->{'minimum_net_price'} : '';
                $startDate = property_exists($etabTypeHeb, 'start_date') ? $etabTypeHeb->{'start_date'} : '';
                $endDate = property_exists($etabTypeHeb, 'end_date') ? $etabTypeHeb->{'end_date'} : '';
                $discountLabel = property_exists($etabTypeHeb, 'minimum_price_discount_label') ? $etabTypeHeb->{'minimum_price_discount_label'} : '';

                $objectEtabTypeHeb
                    ->setLocale($locale)
                    ->setMinimumPrice($minimumPrice)
                    ->setMinimumPriceStartDate($startDate)
                    ->setMinimumPriceEndDate($endDate)
                    ->setMinimumPriceDiscountLabel($discountLabel)
                    ->save($con)
                ;
            }
        }
    }
}
