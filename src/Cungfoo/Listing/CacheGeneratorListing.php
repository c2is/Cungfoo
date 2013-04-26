<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseCacheGeneratorListing;

/**
 * Listing class for 'cache_generator' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class CacheGeneratorListing extends BaseCacheGeneratorListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
        $this->removeColumn('cached_at');
        $this->addColumn(new Column\TextColumn('cache_time'));
    }

} // CacheGeneratorListing
