<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseBonPlan;


/**
 * Skeleton subclass for representing a row from the 'bon_plan' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class BonPlan extends BaseBonPlan
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getRegionsCodes()
    {
        $codes = array();

        foreach ($this->getRegions() as $Region)
        {
            $codes[] = $Region->getCode();
        }

        return implode(',', $codes);
    }

    public function getEtablissementsCodes()
    {
        $codes = array();

        foreach ($this->getEtablissements() as $etablissement)
        {
            $codes[] = $etablissement->getCode();
        }

        return implode(',', $codes);
    }

    public function getCompteur()
    {
        $dateFin = $this->getDateFin();
        $today = new \DateTime();
        $diff = $today->diff($dateFin);

        foreach ($diff as $key => $value)
        {
            if ($key == "d" || $key == "h" || $key == "i")
            {
                $compteur[$key] = $value;
            }
        }

        return $compteur;
    }

    public function getReduction() {
        if ($this->getPrix() && $this->getPrixBarre())
        {
            return (1 - ($this->getPrixBarre() / $this->getPrix())) * 100;
        }
        else
        {
            return 0;
        }
    }
}
