<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseCoordonneesContactListing;

/**
 * Listing class for 'coordonnees_contact' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class CoordonneesContactListing extends BaseCoordonneesContactListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();

        $this->removeColumn('id');
        $this->removeColumn('code_postal');
        $this->removeColumn('pays');
        $this->removeColumn('fax');
    }

} // CoordonneesContactListing
