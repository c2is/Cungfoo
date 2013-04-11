<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseNavigationItemListing;

/**
 * Listing class for 'navigation_item' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class NavigationItemListing extends BaseNavigationItemListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('navigation'));
        $this->addColumn(new Column\TextColumn('title'));
        $this->addColumn(new Column\TextColumn('path'));
    }

} // NavigationItemListing
