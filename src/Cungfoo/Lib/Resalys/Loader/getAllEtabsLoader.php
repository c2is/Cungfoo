<?php

namespace Cungfoo\Lib\Resalys\Loader;

use Cungfoo\Lib\Resalys\Loader\BaseLoader,
    Cungfoo\Model\EtablissementQuery,
    Cungfoo\Model\Etablissement,
    Cungfoo\Model\TypeHebergementQuery,
    Cungfoo\Model\EtablissementTypeHebergementQuery;

class getAllEtabsLoader extends BaseLoader
{
    public function load($data, $locale, \PropelPDO $con)
    {
        try
        {
            $removeObsoleteEtabs = EtablissementQuery::create();
            foreach ($data->etab as $etab)
            {
                $objectEtab = $this->updateEtab($etab, $locale, $con);
                if ($objectEtab)
                {
                    $removeObsoleteEtabs->prune($objectEtab);
                }
            }

            $removeObsoleteEtabs->delete($con);
        }
        catch (\Exception $exception)
        {
            throw new \Exception($exception);
        }
    }

    protected function updateEtab($etab, $locale, \PropelPDO $con)
    {
        $objectEtab = EtablissementQuery::create()
            ->filterByCode($etab->{'id'})
            ->findOne($con)
        ;

        if (!$objectEtab)
        {
            $objectEtab = new Etablissement();
            $objectEtab->setCode($etab->{'id'});
        }

        $objectEtab->setLocale($locale);

        $objectEtab->setName($etab->{'name'});
        $objectEtab->setAddress1($etab->{'address'}->{'address1'});
        $objectEtab->setAddress2($etab->{'address'}->{'address2'});
        $objectEtab->setZip($etab->{'address'}->{'zip'});
        $objectEtab->setCity($etab->{'address'}->{'city'});
        $objectEtab->setCountry($etab->{'address'}->{'country'});
        $objectEtab->setMail($etab->{'address'}->{'mail'});
        $objectEtab->setCountryCode($etab->{'address'}->{'country_code'});
        $objectEtab->setPhone1($etab->{'address'}->{'phone1'});
        $objectEtab->setPhone2($etab->{'address'}->{'phone2'});
        $objectEtab->setFax($etab->{'address'}->{'fax'});
        $objectEtab->setOpeningDate($etab->{'opening_date'});
        $objectEtab->setClosingDate($etab->{'closing_date'});

        // update type hebergement
        $this->updateTypeHebergement($objectEtab, $etab->{'roomtypes'}, $con);

        // update theme
        if (isset($etab->{'themecodes'}->{'themecode'}))
        {
            $this->updateTheme($objectEtab, $etab->{'themecodes'}->{'themecode'}, $con);
        }

        $objectEtab->save($con);

        return $objectEtab;
    }

    protected function updateTypeHebergement($objectEtab, $roomtypesGroup, \PropelPDO $con)
    {
        foreach ($roomtypesGroup as $roomtypes)
        {
            foreach ($roomtypes as $roomtype)
            {
                if (is_object($roomtype) && property_exists($roomtype, 'code'))
                {
                    $objectTypeHebergement = TypeHebergementQuery::create()
                        ->filterByCode($roomtype->code)
                        ->findOne($con)
                    ;

                    if ($objectTypeHebergement)
                    {
                        $objectEtabHasTypeHebergement = EtablissementTypeHebergementQuery::create()
                            ->filterByEtablissementId($objectEtab->getId())
                            ->filterByTypeHebergementId($objectTypeHebergement->getId())
                            ->findOne()
                        ;

                        if (!$objectEtabHasTypeHebergement)
                        {
                            $objectEtab->addTypeHebergement($objectTypeHebergement, $con);
                        }
                    }
                }
            }
        }
    }

    protected function updateTheme($objectEtab, $themecodes, \PropelPDO $con)
    {
        foreach ($themecodes as $themecode)
        {
            foreach ($this->config['EtabLoader']['themes'] as $themeName => $themeConfig)
            {
                $modelQuery = sprintf('%sQuery', $this->config['EtabLoader']['themes'][$themeName]['model']);
                $objectTheme = $modelQuery::create()
                    ->filterByCode($themecode)
                    ->findOne($con)
                ;

                if ($objectTheme)
                {
                    if (strpos($this->config['EtabLoader']['themes'][$themeName]['setter'], 'set') === 0)
                    {
                        $themeSetter = $this->config['EtabLoader']['themes'][$themeName]['setter'];
                        $objectEtab->$themeSetter($objectTheme);
                        break;
                    }
                    else
                    {
                        $modelAssociatedQuery = sprintf('%sQuery', $this->config['EtabLoader']['themes'][$themeName]['associated']);
                        $filterAssociated     = $this->config['EtabLoader']['themes'][$themeName]['filter'];

                        $objectEtabHasTheme = $modelAssociatedQuery::create()
                            ->filterByEtablissementId($objectEtab->getId())
                            ->$filterAssociated($objectTheme->getId())
                            ->findOne($con)
                        ;

                        if (!$objectEtabHasTheme)
                        {
                            $themeSetter = $this->config['EtabLoader']['themes'][$themeName]['setter'];
                            $objectEtab->$themeSetter($objectTheme);
                            break;
                        }
                    }
                }
            }
        }
    }
}