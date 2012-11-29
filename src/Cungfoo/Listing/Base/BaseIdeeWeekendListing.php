<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'idee_weekend' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseIdeeWeekendListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\BooleanColumn('highlight'));
        $this->addColumn(new Column\TextColumn('prix'));
        $this->addColumn(new Column\BooleanColumn('home'));
        $this->addColumn(new Column\TextColumn('lien'));
        $this->addColumn(new Column\BooleanColumn('image_path'));
        $this->addColumn(new Column\BooleanColumn('active'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'IdeeWeekend';
    }

} // BaseIdeeWeekendListing
