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
            "base_id"                            =>getOption('base_id', ''),
            "username"                           =>getOption('username', ''),
            "password"                           =>getOption('password', ''),
            "search_form_etab_list"              =>getOption('etab_list', ''),
            "search_form_start_date"             =>getOption('start_date', ''),
            "search_form_lookup_month"           =>getOption('lookup_month', ''),
            "search_form_nb_days"                =>getOption('nb_days', ''),
            "search_form_nb_adults"              =>getOption('nb_adults', ''),
            "search_form_campaign_list"          =>getOption('campaign_list', ''),
            "webuser"                            =>getOption('webuser', ''),
            "partner_code"                       =>getOption('partner_code', ''),
            "service_id"                         =>getOption('service_id', ''),
            "search_form_sort_string"            =>getOption('sort_string', ''),
            "search_form_search_themes"          =>getOption('search_themes', ''),
            "search_form_period_categories"      =>getOption('period_categories', ''),
            "search_form_nb_children_1"          =>getOption('nb_children_1', ''),
            "search_form_nb_children_2"          =>getOption('nb_children_2', ''),
            "search_form_nb_babies"              =>getOption('nb_babies', ''),
            "search_form_max_results"            =>getOption('max_results', ''),
            "search_form_product_code"           =>getOption('product_code', ''),
            "search_form_room_type"              =>getOption('room_type', ''),
            "search_form_room_type_category"     =>getOption('room_type_category', ''),
            "search_form_min_budget"             =>getOption('min_budget', ''),
            "search_form_max_budget"             =>getOption('max_budget', ''),
            "search_form_birth_dates"            =>getOption('birth_dates', ''),
            "search_form_room_features"          =>getOption('room_features', ''),
            "search_form_yield_rule"             =>getOption('yield_rule', ''),
            "search_form_occupant_base_products" =>getOption('occupant_base_products', ''),
        );
    }
}
