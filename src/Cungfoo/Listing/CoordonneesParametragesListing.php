<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseCoordonneesParametragesListing;

/**
 * Listing class for 'coordonnees_parametrages' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class CoordonneesParametragesListing extends BaseCoordonneesParametragesListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->removeColumn('name');
        $this->removeColumn('value');
        $this->removeColumn('is_usine');
        $this->addColumn(new Column\TextColumn('description'));
        $this->addColumn(new Column\TextColumn('value'));

    }

} // CoordonneesParametragesListing
