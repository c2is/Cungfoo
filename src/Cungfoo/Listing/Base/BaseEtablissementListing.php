<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'etablissement' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseEtablissementListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('name'));
        $this->addColumn(new Column\TextColumn('address1'));
        $this->addColumn(new Column\TextColumn('address2'));
        $this->addColumn(new Column\TextColumn('zip'));
        $this->addColumn(new Column\TextColumn('city'));
        $this->addColumn(new Column\TextColumn('mail'));
        $this->addColumn(new Column\TextColumn('country'));
        $this->addColumn(new Column\TextColumn('country_code'));
        $this->addColumn(new Column\TextColumn('phone1'));
        $this->addColumn(new Column\TextColumn('phone2'));
        $this->addColumn(new Column\TextColumn('fax'));
        $this->addColumn(new Column\TextColumn('ville_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Etablissement';
    }

} // BaseEtablissementListing