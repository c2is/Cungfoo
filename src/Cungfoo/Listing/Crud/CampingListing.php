<?php

namespace Cungfoo\Listing\Crud;

use Cungfoo\Listing\Listing,
    Cungfoo\Listing\Column;

use Cungfoo\Listing\Crud\Base\BaseCampingListing;

/**
 * Listing class for 'camping' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Crud
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
