<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'coordonnees_parametrages' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseCoordonneesParametragesListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('value'));
        $this->addColumn(new Column\TextColumn('is_usine'));
        $this->addColumn(new Column\TextColumn('active'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CoordonneesParametrages';
    }

} // BaseCoordonneesParametragesListing
