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
            ->addColumn(new Column\LinkColumn('name'))
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
