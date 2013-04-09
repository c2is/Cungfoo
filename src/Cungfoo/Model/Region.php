<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseRegion;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Skeleton subclass for representing a row from the 'region' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class Region extends BaseRegion
{
    public function __toString()
    {
        return $this->getName();
    }

    public function isFrance()
    {
        return $this->getPays()->isFrance();
    }
}
