<?php

namespace Cungfoo\Listing\Crud;

use Cungfoo\Listing\Listing,
    Cungfoo\Listing\Column;

use Cungfoo\Listing\Crud\Base\BaseSaisonListing;

/**
 * Listing class for 'saison' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Crud
 */
class SaisonListing extends BaseSaisonListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
    }

} // SaisonListing
