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
        $this->addColumn(new Column\TextColumn('image_path'));
        $this->addColumn(new Column\TextColumn('image_encart_path'));
        $this->addColumn(new Column\TextColumn('image_encart_petite_path'));
        $this->addColumn(new Column\TextColumn('mea_home'));
        $this->addColumn(new Column\TextColumn('image_detail_1'));
        $this->addColumn(new Column\TextColumn('image_detail_2'));
        $this->addColumn(new Column\TextColumn('active'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Region';
    }

} // BaseRegionListing
