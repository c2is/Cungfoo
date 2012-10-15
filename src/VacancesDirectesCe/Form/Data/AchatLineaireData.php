<?php

namespace VacancesDirectesCe\Form\Data;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

class AchatLineaireData
{
    public $nbAdultes = 1;
    public $pays;
    public $region;
    public $campings;
    public $dateDebut;
    public $dateFin;

    public function isValide(ExecutionContext $context)
    {
        if (!$this->nbAdultes)
        {
            $context->addViolation("Le nombre d'adultes doit être renseigné.");
        }

        if (!$this->dateDebut)
        {
            $context->addViolation("La date de début doit être renseignée.");
        }
        else
        {
            $aDateDebut = explode('/', $this->dateDebut);
            $dateDebutDate    = new \DateTime(sprintf('%s/%s/%s', $aDateDebut[1], $aDateDebut[0], $aDateDebut[2]));
            $debutJuilletDate = new \DateTime('06/30/2013');

            $dateDebutTimestamp = $dateDebutDate->getTimestamp();

            if ($dateDebutTimestamp > $debutJuilletDate->getTimestamp())
            {
                $context->addViolation("La date de début doit être inférieur au 30 juin 2013.");
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
            $finAoutDate = new \DateTime('08/30/2013');

            $dateFinTimestamp = $dateFinDate->getTimestamp();

            if ($dateFinTimestamp < $finAoutDate->getTimestamp())
            {
                $context->addViolation("La date de fin doit être supérieur au 30 aout 2013.");
            }
        }
    }
}
