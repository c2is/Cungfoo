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
    public $isCamping          = 0;

    public $nbJoursBasseSaison = 0;
    public $nbJoursHauteSaison = 0;
    public $isBasseSaison      = 1;

    public $nbAdultes          = 2;
    public $nbEnfants          = 0;

    public function isValide(ExecutionContext $context)
    {
        if (empty($this->destination) and empty($this->ville) and empty($this->camping))
        {
            $context->addViolation('date_search.destination.required', array (), null);
        }
        else if ($this->destination === "FRA" && !($this->ville || $this->camping))
        {
            $context->addViolation('date_search.ville.required', array (), null);
        }

        if ($this->dateDebut || $this->nbJoursBasseSaison || $this->nbJoursHauteSaison)
        {
            if (!$this->dateDebut)
            {
                $context->addViolation('date_search.date_debut.required', array (), null);
            }

            if ($this->nbAdultes === null or $this->nbAdultes == '')
            {
                $context->addViolation('date_search.nb_adultes.required', array (), null);
            }

            if ($this->nbAdultes < 1 or $this->nbAdultes > 6)
            {
                $context->addViolation('date_search.nb_adultes.range', array (), null);
            }

            if ($this->nbEnfants < 0 or $this->nbEnfants > 6)
            {
                $context->addViolation('date_search.nb_enfants.range', array (), null);
            }

            if (($this->isBasseSaison && $this->nbJoursBasseSaison < 1) || (!$this->isBasseSaison && $this->nbJoursHauteSaison < 1))
            {
                $context->addViolation('date_search.nb_jours.required', array (), null);
            }
        }
    }
}
