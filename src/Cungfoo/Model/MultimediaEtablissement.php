<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BaseMultimediaEtablissement;


/**
 * Skeleton subclass for representing a row from the 'multimedia_etablissement' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class MultimediaEtablissement extends BaseMultimediaEtablissement
{
    public function __toString()
    {
        return $this->getTitre();
    }

    public function getTagsForDisplay()
    {
        $tags = $this->getTags();
        $arrayNames = array();

        foreach($tags as $tag)
        {
            $arrayNames[] = $tag->getSlug();
        }

        $names = implode(" ", $arrayNames);

        return $names;
    }
}