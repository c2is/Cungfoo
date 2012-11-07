<?php

namespace VacancesDirectesCe\Form\Data;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

class AchatLineaireData
{
    public $nbAdultes = null;
    public $nbEnfants = null;
    public $pays;
    public $region;
    public $campings;
    public $dateDebut;
    public $dateFin;
    public $isBasseSaison = false;

    public function isValid(ExecutionContext $context)
    {
        if ($this->nbAdultes === null)
        {
            $context->addViolation("Le nombre d'adultes doit être renseigné.");
        }

        if ($this->nbEnfants === null)
        {
            $this->nbEnfants = 0;
        }

        if (!$this->dateDebut)
        {
            $context->addViolation("La date de début doit être renseignée.");
        }
        else
        {
            $aDateDebut = explode('/', $this->dateDebut);
            $dateDebutDate    = new \DateTime(sprintf('%s/%s/%s', $aDateDebut[1], $aDateDebut[0], $aDateDebut[2]));
            $debutJuilletDate = new \DateTime('07/06/2013');

            $dateDebutTimestamp = $dateDebutDate->getTimestamp();

            if (!$this->isBasseSaison && $dateDebutTimestamp > $debutJuilletDate->getTimestamp())
            {
                $context->addViolation("La date de début doit être inférieur au 6 juillet 2013.");
            }
        }

        if (!$this->dateFin)
        {
            $context->addViolation("La date de fin doit être renseignée.");
        }
        else
        {
            $aDateFin = explode('/', $this->dateFin);
            $dateFinDate    = new \DateTime(sprintf('%s/%s/%s', $aDateFin[1], $aDateFin[0], $aDateFin[2]));
            $finAoutDate = new \DateTime('08/31/2013');

            $dateFinTimestamp = $dateFinDate->getTimestamp();

            if (!$this->isBasseSaison && $dateFinTimestamp < $finAoutDate->getTimestamp())
            {
                $context->addViolation("La date de fin doit être supérieur au 31 aout 2013.");
            }
        }
    }
}
