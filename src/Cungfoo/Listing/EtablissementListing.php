<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseEtablissementListing;

/**
 * Listing class for 'etablissement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class EtablissementListing extends BaseEtablissementListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();

        $this->removeColumn('address1');
        $this->removeColumn('address2');
        $this->removeColumn('zip');
        $this->removeColumn('country_code');
        $this->removeColumn('ville_id');
        $this->removeColumn('phone2');
        $this->removeColumn('fax');
        $this->removeColumn('mail');
    }

} // EtablissementListing
