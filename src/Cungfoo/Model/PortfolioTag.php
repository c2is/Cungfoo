<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BasePortfolioTag;


/**
 * Skeleton subclass for representing a row from the 'portfolio_tag' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class PortfolioTag extends BasePortfolioTag
{
    public function __toString()
    {
        return (string) $this->getName();
    }
}
