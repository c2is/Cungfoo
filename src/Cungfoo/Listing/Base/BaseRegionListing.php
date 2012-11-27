<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'region' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseRegionListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('code'));
        $this->addColumn(new Column\TextColumn('code_viafrance'));
        $this->addColumn(new Column\TextColumn('enabled'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Region';
    }

} // BaseRegionListing
