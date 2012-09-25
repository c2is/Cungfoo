<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'point_interet' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BasePointInteretListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('address'));
        $this->addColumn(new Column\TextColumn('address2'));
        $this->addColumn(new Column\TextColumn('zipcode'));
        $this->addColumn(new Column\TextColumn('city'));
        $this->addColumn(new Column\TextColumn('image'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'PointInteret';
    }

} // BasePointInteretListing
