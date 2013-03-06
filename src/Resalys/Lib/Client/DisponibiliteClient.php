<?php

namespace Resalys\Lib\Client;

use Silex\Application;
use Symfony\Component\Yaml\Yaml;

class DisponibiliteClient extends AbstractClient
{
    protected function getName()
    {
        return 'disponibilite';
    }

    protected function getRequests()
    {
        return array(
            'getProposals65',
        );
    }

    protected function getEnvelopeFormat()
    {
        return array(
            "base_id"                            => $this->getOption('base_id', ''),
            "username"                           => $this->getOption('username', ''),
            "password"                           => $this->getOption('password', ''),
            "search_form_etab_list"              => $this->getOption('etab_list', ''),
            "search_form_start_date"             => $this->getOption('start_date', ''),
            "search_form_lookup_month"           => $this->getOption('lookup_month', ''),
            "search_form_nb_days"                => $this->getOption('nb_days', ''),
            "search_form_nb_adults"              => $this->getOption('nb_adults', ''),
            "search_form_campaign_list"          => $this->getOption('campaign_list', ''),
            "webuser"                            => $this->getOption('webuser', ''),
            "partner_code"                       => $this->getOption('partner_code', ''),
            "service_id"                         => $this->getOption('service_id', ''),
            "search_form_sort_string"            => $this->getOption('sort_string', 'Price,Priority,StartDate,Etab,RoomType(2),ProductPriority'),
            "search_form_search_themes"          => $this->getOption('search_themes', ''),
            "search_form_period_categories"      => $this->getOption('period_categories', ''),
            "search_form_nb_children_1"          => $this->getOption('nb_children_1', ''),
            "search_form_nb_children_2"          => $this->getOption('nb_children_2', ''),
            "search_form_nb_babies"              => $this->getOption('nb_babies', ''),
            "search_form_max_results"            => $this->getOption('max_results', '999'),
            "search_form_product_code"           => $this->getOption('product_code', ''),
            "search_form_room_type"              => $this->getOption('room_type', ''),
            "search_form_room_type_category"     => $this->getOption('room_type_category', ''),
            "search_form_min_budget"             => $this->getOption('min_budget', ''),
            "search_form_max_budget"             => $this->getOption('max_budget', ''),
            "search_form_birth_dates"            => $this->getOption('birth_dates', ''),
            "search_form_room_features"          => $this->getOption('room_features', ''),
            "search_form_yield_rule"             => $this->getOption('yield_rule', ''),
            "search_form_occupant_base_products" => $this->getOption('occupant_base_products', ''),
        );
    }
}
