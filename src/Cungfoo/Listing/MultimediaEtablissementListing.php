<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseMultimediaEtablissementListing;

/**
 * Listing class for 'multimedia_etablissement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class MultimediaEtablissementListing extends BaseMultimediaEtablissementListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->addColumn(new Column\TextColumn('titre'));
    }

} // MultimediaEtablissementListing
