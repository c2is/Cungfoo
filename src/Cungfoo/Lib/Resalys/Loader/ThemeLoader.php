<?php

namespace Cungfoo\Lib\Resalys\Loader;

use \Cungfoo\Lib\Resalys\Loader\BaseLoader;

class ThemeLoader extends BaseLoader
{
    protected $themeCategories = array();

    public function load($locale = 'fr', \PropelPDO $con = null)
    {
        if ($con === null)
        {
            $con = \Propel::getConnection();
        }

        $con->beginTransaction();

        try
        {
            foreach ($this->sort() as $category)
            {
                foreach ($category as $theme)
                {
                    if (!array_key_exists($theme->{'category'}, $this->config['ThemeLoader']['themes']))
                    {
                        continue;
                    }

                    $queryClass = sprintf('%sQuery', $this->config['ThemeLoader']['themes'][$theme->{'category'}]['model']);
                    $objectTheme = $queryClass::create()
                        ->filterById($theme->{'id'})
                        ->findOne($con)
                    ;

                    if (!$objectTheme)
                    {
                        $modelClass = $this->config['ThemeLoader']['themes'][$theme->{'category'}]['model'];
                        $objectTheme = new $modelClass();
                        $objectTheme->setId($theme->{'id'});
                    }

                    $objectTheme->setLocale($locale);
                    $objectTheme->setName($theme->{'name'});

                    if ($theme->{'parent'})
                    {
                        if (empty($this->config['ThemeLoader']['themes'][$theme->{'category'}]['parent']))
                        {
                            throw new \Exception(sprintf('Please set the parent to the %s theme.', $theme->{'category'}));
                        }

                        $setParent = sprintf('set%sId', $this->config['ThemeLoader']['themes'][$theme->{'category'}]['parent']);
                        $objectTheme->$setParent($theme->{'parent'});
                    }

                    $objectTheme->save($con);
                    $this->themeCategories[$theme->{'category'}][$objectTheme->getId()] = $objectTheme;
                }
            }

            $this->removeObsoleteThemes($con);

            $con->commit();
        }
        catch (\Exception $exception)
        {
            $con->rollBack();
            throw $exception;
        }
    }

    protected function sort()
    {
        $sortedData = array_fill_keys(array_keys($this->config['ThemeLoader']['themes']), array());

        foreach ($this->data->theme as $theme)
        {
            $sortedData[$theme->category][] = $theme;
        }

        return $sortedData;
    }

    protected function removeObsoleteThemes(\PropelPDO $con)
    {
        foreach ($this->themeCategories as $category => $themes)
        {
            if (count($themes) > 0)
            {
                $queryClass = sprintf('%sQuery', $this->config['ThemeLoader']['themes'][$category]['model']);
                $themeQuery = $queryClass::create();

                foreach ($themes as $theme)
                {
                    $themeQuery->prune($theme);
                }

                $themeQuery->delete($con);
            }
        }
    }
}