<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseTypeHebergementListing;

/**
 * Listing class for 'type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class TypeHebergementListing extends BaseTypeHebergementListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('name'));
        $this->addColumn(new Column\TextColumn('category_type_hebergement'));
        $this->addColumn(new Column\TextColumn('indice'));
        $this->removeColumn('image_hebergement_path');
        $this->removeColumn('image_composition_path');
    }

} // TypeHebergementListing
