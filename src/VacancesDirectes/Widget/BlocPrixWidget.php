<?php

namespace VacancesDirectes\Widget;

use Symfony\Component\HttpFoundation\Request;

use Cungfoo\Model\EtablissementQuery,
    Cungfoo\Widget\AbstractWidget;

class BlocPrixWidget extends AbstractWidget
{
    protected function requiredParameters()
    {
        return array('etab');
    }

    public function getName()
    {
        return 'bloc_prix';
    }

    public function render()
    {
        $etab = (int) $this->app['request']->query->get('etab');
        
        $camping = EtablissementQuery::create()
            ->filterByCode($etab)
            ->findOne()
        ; 
        $lastProposal = $this->app['session']->get('last_proposal');
        $blocPrix = array();

        if (is_array($lastProposal) && is_object($lastProposal['proposal']) && $lastProposal['proposal']->etab_id == $etab)
        {
            $category = \Cungfoo\Model\CategoryTypeHebergementQuery::create()
                ->filterByCode($lastProposal['proposal']->{'room_type_category'})
                ->findOne()
            ;

            $blocPrix['proposal_key']                  = $lastProposal['proposal']->{'proposal_key'};
            $blocPrix['start_date']                    = $lastProposal['proposal']->{'start_date'};
            $blocPrix['end_date']                      = $lastProposal['proposal']->{'end_date'};
            $blocPrix['room_type_label']               = $lastProposal['proposal']->{'room_types'}->{'room_type'}->{'room_type_label'};
            $blocPrix['adult_price_without_discounts'] = $lastProposal['proposal']->{'adult_price_without_discounts'};
            $blocPrix['adult_price']                   = $lastProposal['proposal']->{'adult_price'};
            $blocPrix['adult_price_pourcent']          = round(100 - (100 * $lastProposal['proposal']->{'adult_price'} / $lastProposal['proposal']->{'adult_price_without_discounts'}));
            $blocPrix['category_hebergement']          = $category ? $category->getName() : '';
        }
        else
        {
            $minimumPriceType = $camping->getMinimumPriceType();
            $blocPrix['proposal_key'] = false;
            $blocPrix['start_date']                    = $minimumPriceType ? $minimumPriceType->getMinimumPriceStartDate('d/m/Y') : null;
            $blocPrix['end_date']                      = $minimumPriceType ? $minimumPriceType->getMinimumPriceEndDate('d/m/Y') : null;
            $blocPrix['adult_price_without_discounts'] = $minimumPriceType ? $minimumPriceType->getMinimumPrice() : 0;
            $blocPrix['type_hebergement']              = $minimumPriceType ? $minimumPriceType->getTypeHebergement()->getName() : '';
            $blocPrix['category_hebergement']          = $minimumPriceType ? $minimumPriceType->getTypeHebergement()->getCategoryTypeHebergement()->getName() : '';
        }

        return $this->app['twig']->render('Widget\\bloc_prix.twig', array(
            'blocPrix' => $blocPrix
        ));
    }
}