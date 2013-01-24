<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseCategoryTypeHebergementListing;

/**
 * Listing class for 'category_type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class CategoryTypeHebergementListing extends BaseCategoryTypeHebergementListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();

        $this->addColumn(new Column\TextColumn('name'));
        $this->removeColumn('minimum_price');
        $this->removeColumn('image_menu');
        $this->removeColumn('image_page');
    }

} // CategoryTypeHebergementListing
