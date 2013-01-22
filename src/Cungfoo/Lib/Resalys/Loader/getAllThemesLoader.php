<?php

namespace Cungfoo\Lib\Resalys\Loader;

use Cungfoo\Lib\Resalys\Loader\AbstractLoader;

class getAllThemesLoader extends AbstractLoader
{
    public function load($data, $locale, \PropelPDO $con)
    {
        try
        {
            foreach ($this->sort($data) as $category => $themes)
            {
                $queryClass = sprintf('%sQuery', $this->config['ThemeLoader']['themes'][$category]['model']);
                $themeQuery = $queryClass::create();

                foreach ($themes as $theme)
                {
                    $queryClass = sprintf('%sQuery', $this->config['ThemeLoader']['themes'][$category]['model']);
                    $objectTheme = $queryClass::create()
                        ->filterByCode($theme->{'id'})
                        ->findOne($con)
                    ;

                    if (!$objectTheme)
                    {
                        $modelClass = $this->config['ThemeLoader']['themes'][$category]['model'];
                        $objectTheme = new $modelClass();
                        $objectTheme->setCode($theme->{'id'});
                    }

                    $objectTheme->setLocale($locale);
                    $objectTheme->setName($theme->{'name'});

                    if ($theme->{'parent'})
                    {
                        if (empty($this->config['ThemeLoader']['themes'][$category]['parent']['name']))
                        {
                            throw new \Exception(sprintf('Please set the parent name to the %s theme.', $theme->{'category'}));
                        }

                        $parentCategory = $this->config['ThemeLoader']['themes'][$category]['parent']['name'];
                        if (empty($this->config['ThemeLoader']['themes'][$parentCategory]['model']))
                        {
                            throw new \Exception(sprintf('Please set the %s theme.', $parentCategory));
                        }

                        if (empty($this->config['ThemeLoader']['themes'][$category]['parent']['setter']))
                        {
                            throw new \Exception(sprintf('Please set the parent setter to the %s theme.', $category));
                        }

                        $setParent = $this->config['ThemeLoader']['themes'][$category]['parent']['setter'];

                        $parentQuery = sprintf('%sQuery', $this->config['ThemeLoader']['themes'][$parentCategory]['model']);
                        $objectThemeParent = $parentQuery::create()
                            ->select(array('id'))
                            ->filterByCode($theme->{'parent'})
                            ->findOne($con)
                        ;

                        $objectTheme->$setParent($objectThemeParent);
                    }

                    $objectTheme->save($con);
                    $themeQuery->prune($objectTheme);
                }

                if ($themeQuery->find()->count())
                {
                    $themeIdDeleted = $themeQuery->select('id')->find($con)->toArray();
                    $themeDeleted = $queryClass::create()
                        ->filterById($themeIdDeleted)
                        ->delete($con)
                    ;
                }
            }
        }
        catch (\Exception $exception)
        {
            throw $exception;
        }
    }

    protected function sort($data)
    {
        $sortedData = array_fill_keys(array_keys($this->config['ThemeLoader']['themes']), array());

        foreach ($data->theme as $theme)
        {
            if (array_key_exists($theme->category, $sortedData))
            {
                $sortedData[$theme->category][] = $theme;
            }
        }

        return $sortedData;
    }
}
