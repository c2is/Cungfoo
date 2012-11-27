<?php

namespace VacancesDirectes\Form\Data\Search;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

class DateData
{
    public $dateDebut;
    public $destination;
    public $ville;
    public $camping;
    public $nbJours   = 0;
    public $isCamping = 0;
    public $nbAdultes = 2;
    public $nbEnfants = 0;

    public function isValide(ExecutionContext $context)
    {
        if (!$this->destination)
        {
            $context->addViolation('date_search.destination.required', array (), null);
        }
        else if ($this->destination === "FRA" && !($this->ville || $this->camping))
        {
            $context->addViolation('date_search.ville.required', array (), null);
        }

        if ($this->dateDebut || $this->nbJours)
        {
            if (!$this->dateDebut)
            {
                $context->addViolation('date_search.date_debut.required', array (), null);
            }

            if ($this->nbAdultes < 1)
            {
                $context->addViolation('date_search.nb_adultes.required', array (), null);
            }

            if ($this->nbJours < 1)
            {
                $context->addViolation('date_search.nb_jours.required', array (), null);
            }
        }
    }
}
