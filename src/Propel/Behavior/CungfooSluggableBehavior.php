<?php

class CungfooSluggableBehavior extends Behavior
{
    // default parameters value
    protected $parameters = array(
        'default_value' => 'n-a',
    );

    public function objectFilter(&$script)
    {
        if ($this->getTable()->hasBehavior('i18n') and strpos($this->getTable()->getBehavior('i18n')->getParameter('i18n_columns'), 'slug') !== false)
        {
        $newGetSlugMethod = sprintf("
\t/**
\t * Get the [slug] column value.
\t *
\t * @return string
\t */
\tpublic function getSlug()
\t{
\t    return \$this->getCurrentTranslation()->getSlug() ?: '%s';
\t}
", $this->getParameter('default_value'));
        } else {
            $newGetSlugMethod = sprintf("
\t/**
\t * Get the [slug] column value.
\t *
\t * @return string
\t */
\tpublic function getSlug()
\t{
\t    return \$this->slug ?: '%s';
\t}
", $this->getParameter('default_value'));
        }

        $parser = new PropelPHPParser($script, true);
        $parser->replaceMethod('getSlug', $newGetSlugMethod);
        $script = $parser->getCode();
    }
}
