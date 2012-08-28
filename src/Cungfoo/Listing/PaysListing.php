<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BasePaysListing;

/**
 * Listing class for 'pays' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class PaysListing extends BasePaysListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('name'));
    }

} // PaysListing
