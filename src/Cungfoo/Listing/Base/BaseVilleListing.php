<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'ville' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseVilleListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('code'));
        $this->addColumn(new Column\BooleanColumn('image_detail_1'));
        $this->addColumn(new Column\BooleanColumn('image_detail_2'));
        $this->addColumn(new Column\BooleanColumn('active'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Ville';
    }

} // BaseVilleListing
