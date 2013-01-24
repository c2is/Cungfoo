<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseTypeHebergementCapaciteListing;

/**
 * Listing class for 'type_hebergement_capacite' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class TypeHebergementCapaciteListing extends BaseTypeHebergementCapaciteListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();

        $this->addColumn(new Column\TextColumn('name'));
        $this->removeColumn('image_menu');
        $this->removeColumn('image_page');
    }

} // TypeHebergementCapaciteListing
