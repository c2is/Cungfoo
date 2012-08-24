<?php

namespace Cungfoo\Listing\Base;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

/**
 * Generated listing class for 'document_i18n' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Base
 */
class BaseDocumentI18nListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('id'));
        $this->addColumn(new Column\TextColumn('locale'));
        $this->addColumn(new Column\TextColumn('locale'));
        $this->addColumn(new Column\TextColumn('title'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'DocumentI18n';
    }

} // BaseDocumentI18nListing
