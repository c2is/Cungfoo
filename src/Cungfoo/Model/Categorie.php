<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseCategorie;


/**
 * Skeleton subclass for representing a row from the 'categorie' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class Categorie extends BaseCategorie
{
    public function __toString()
    {
        return $this->getName();
    }

    public function getStars()
    {
        switch ($this->getCode())
        {
            case '1ETO':
                return '*';
                break;
            case '2ETO':
                return '**';
                break;
            case '3ETO':
                return '***';
                break;
            case '4ETO':
                return '****';
                break;
            case '5ETO':
                return '*****';
                break;
        }
    }
}
