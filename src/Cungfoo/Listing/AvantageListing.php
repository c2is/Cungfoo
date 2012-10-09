<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseAvantageListing;

/**
 * Listing class for 'avantage' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class AvantageListing extends BaseAvantageListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();

        $this->addColumn(new Column\TextColumn('personnage'));
        $this->addColumn(new Column\TextColumn('name'));
        $this->addColumn(new Column\TextColumn('description'));
    }

} // AvantageListing
