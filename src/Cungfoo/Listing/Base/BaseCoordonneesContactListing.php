<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'coordonnees_contact' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseCoordonneesContactListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('nom'));
        $this->addColumn(new Column\TextColumn('prenom'));
        $this->addColumn(new Column\TextColumn('ville'));
        $this->addColumn(new Column\TextColumn('code_postal'));
        $this->addColumn(new Column\TextColumn('pays'));
        $this->addColumn(new Column\TextColumn('email'));
        $this->addColumn(new Column\TextColumn('telephone'));
        $this->addColumn(new Column\TextColumn('fax'));
        $this->addColumn(new Column\TextColumn('active'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'CoordonneesContact';
    }

} // BaseCoordonneesContactListing
