<?php

namespace Cungfoo\Listing\Crud;

use Cungfoo\Listing\Listing,
    Cungfoo\Listing\Column;

use Cungfoo\Listing\Crud\Base\BaseAuthorListing;

/**
 * Listing class for 'author' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Crud
 */
class AuthorListing extends BaseAuthorListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
    }

} // AuthorListing
