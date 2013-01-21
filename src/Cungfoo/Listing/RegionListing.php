<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseRegionListing;

/**
 * Listing class for 'region' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class RegionListing extends BaseRegionListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('name'));
        $this->addColumn(new Column\TextColumn('pays'));
        $this->removeColumn('image_path');
        $this->removeColumn('image_encart_path');
        $this->removeColumn('image_encart_petite_path');
        $this->removeColumn('mea_home');
        $this->removeColumn('image_detail_1');
        $this->removeColumn('image_detail_2');
    }

} // RegionListing
