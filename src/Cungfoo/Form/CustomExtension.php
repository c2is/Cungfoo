<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cungfoo\Form;

use Cungfoo\Form\Type;
use Symfony\Component\Form\AbstractExtension;

/**
 * Represents the cungfoo form extension, which loads the cungfoo functionality.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 */
class CustomExtension extends AbstractExtension
{
    protected function loadTypes()
    {
        return array(
            new Type\ModelType(),
            new Type\TranslationType(),
            new Type\TranslationCollectionType(),
        );
    }
}
