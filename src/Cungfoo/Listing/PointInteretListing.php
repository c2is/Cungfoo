<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BasePointInteretListing;

/**
 * Listing class for 'point_interet' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class PointInteretListing extends BasePointInteretListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('name'));
        $this->removeColumn('address');
        $this->removeColumn('address2');
        $this->removeColumn('code');
        $this->removeColumn('tel');
        $this->removeColumn('fax');
        $this->removeColumn('email');
        $this->removeColumn('website');
        $this->removeColumn('zipcode');
        $this->removeColumn('image');
        $this->removeColumn('distance_camping');
        $this->removeColumn('geo_coordinate_x');
        $this->removeColumn('geo_coordinate_y');
    }

} // PointInteretListing
