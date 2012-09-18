<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'etablissement_thematique' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseEtablissementThematiqueListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('etablissement_id'));
        $this->addColumn(new Column\TextColumn('thematique_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'EtablissementThematique';
    }

} // BaseEtablissementThematiqueListing
