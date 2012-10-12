<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'type_hebergement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseTypeHebergementListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('code'));
        $this->addColumn(new Column\TextColumn('surface'));
        $this->addColumn(new Column\TextColumn('type_terrasse'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'TypeHebergement';
    }

} // BaseTypeHebergementListing
