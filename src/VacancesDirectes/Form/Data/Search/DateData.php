<?php

namespace VacancesDirectes\Form\Data\Search;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

class DateData
{
    public $date;
    public $destination;
    public $ville;
    public $camping;
    public $nbAdultes = 0;
    public $nbEnfants = 0;

    public function isValide(ExecutionContext $context)
    {
        if (!$this->destination)
        {
            $context->addViolation('destination is required', array (), null);
        }
        else
        {
            $pays = get_class($this->destination) == "Cungfoo\Model\Pays" ?: $this->destination->getPays();
            if ($pays->getName() == "France" && !($this->ville || $this->camping))
            {
                $context->addViolation('ville or camping is required', array (), null);
            }
        }

        if ($this->date)
        {
            if ($this->nbAdultes < 1)
            {
                $context->addViolation('adultes is required', array (), null);
            }
        }
    }
}