<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseEventListing;

/**
 * Listing class for 'event' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class EventListing extends BaseEventListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('name'));
        $this->removeColumn('priority');
        $this->removeColumn('address');
        $this->removeColumn('address2');
        $this->removeColumn('zipcode');
        $this->removeColumn('image');
    }

} // EventListing