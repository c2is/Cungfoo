<?php

namespace Cungfoo\Model\om;

use Cungfoo\Listing\Listing,
    Cungfoo\Listing\Column;

class BaseAuthorListing extends Listing
{
    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this
            ->addColumn(new Column\TextColumn('id'))
            ->addColumn(new Column\TextColumn('name'))
            ->addColumn(new Column\TextListColumn('document', array(
                'text_field_name' => 'id'
            )))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Author';
    }

} // BaseAuthorList
