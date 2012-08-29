<?php

namespace Cungfoo\Listing;

use Cungfoo\Lib\Listing\Listing,
    Cungfoo\Lib\Listing\Column;

use Cungfoo\Listing\Base\BaseJobLogListing;

/**
 * Listing class for 'job_log' table.
 *
 * @author  Morgan Brunot <brunot.morgan@gmail.com>
 *          Denis Roussel <denis.roussel@gmail.com>
 * @package propel.generator.Cungfoo.Listing
 */
class JobLogListing extends BaseJobLogListing
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        parent::configure();
    }

} // JobLogListing
