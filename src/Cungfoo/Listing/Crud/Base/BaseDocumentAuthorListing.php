<?php

namespace Cungfoo\Listing\Crud\Base;

use Cungfoo\Listing\Listing,
    Cungfoo\Listing\Column;

/**
 * Generated listing class for 'document_author' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing.Crud.Base
 */
class BaseDocumentAuthorListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->addColumn(new Column\TextColumn('document_id'));
        $this->addColumn(new Column\TextColumn('author_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'DocumentAuthor';
    }

} // BaseDocumentAuthorListing
