<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseCampingListing;

/**
 * Listing class for 'camping' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class CampingListing extends BaseCampingListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
    }

} // CampingListing
