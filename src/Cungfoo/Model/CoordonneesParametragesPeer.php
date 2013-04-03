<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseCoordonneesParametragesPeer;


/**
 * Skeleton subclass for performing query and update operations on the 'coordonnees_parametrages' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class CoordonneesParametragesPeer extends BaseCoordonneesParametragesPeer
{
    const DEMANDE_INFORMATION = 'demande_information';
    const DEMANDE_CATALOGUE   = 'demande_catalogue';
    const RESERVATION_GROÜP   = 'reservation_groupe';
    const RECRUTEMENT         = 'recrutement';
    const ACHAT_DE_MOBIL_HOME = 'achat_mobil_home';
    const INFORMATIONS_CE     = 'informations_ce';

    public static function get($name)
    {
        return CoordonneesParametragesQuery::create()
            ->filterByName($name)
            ->findOne()
        ;
    }
}
