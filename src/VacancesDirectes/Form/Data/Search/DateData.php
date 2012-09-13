<?php

namespace VacancesDirectes\Form\Data\Search;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

class DateData
{
    public $dateDebut;
    public $dateFin;
    public $destination;
    public $ville;
    public $camping;
    public $nbAdultes = 0;
    public $nbEnfants = 0;

    public function isValide(ExecutionContext $context)
    {
        if (!$this->destination)
        {
            $context->addViolation('date_search.destination.required', array (), null);
        }
        else
        {
            $pays = get_class($this->destination) == "Cungfoo\Model\Pays" ?: $this->destination->getPays();
            if ($pays->getName() == "France" && !($this->ville || $this->camping))
            {
                $context->addViolation('date_search.ville.required', array (), null);
            }
        }

        if ($this->dateDebut || $this->dateFin)
        {
            if (!$this->dateFin)
            {
                $context->addViolation('date_search.date_fin.required', array (), null);
            }
            if (!$this->dateDebut)
            {
                $context->addViolation('date_search.date_debut.required', array (), null);
            }
            if ($this->nbAdultes < 1)
            {
                $context->addViolation('date_search.nb_adultes.required', array (), null);
            }
        }
    }
}