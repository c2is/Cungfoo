<?php

namespace Cungfoo\Lib\Resalys\Loader;

use \Cungfoo\Lib\Resalys\Loader\BaseLoader;

class EtabLoader extends BaseLoader
{
    protected $etabs = array();

    public function load($locale = 'fr', \PropelPDO $con = null)
    {
        if ($con === null)
        {
            $con = \Propel::getConnection();
        }

        $con->beginTransaction();

        try
        {
            foreach ($this->data->etab as $etab)
            {
                $this->updateEtab($etab, $locale, $con);
            }

            $this->removeObsoleteEtabs($con);

            $con->commit();
        }
        catch (\Exception $exception)
        {
            $con->rollBack();
            throw new \Exception($exception);
        }
    }

    protected function updateEtab($etab, $locale, \PropelPDO $con)
    {

        $objectEtab = \Cungfoo\Model\EtablissementQuery::create()
            ->filterByCode($etab->{'id'})
            ->findOne($con)
        ;

        if (!$objectEtab)
        {
            $objectEtab = new \Cungfoo\Model\Etablissement();
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
        $this->etabs[] = $objectEtab;
    }

    protected function updateTypeHebergement($objectEtab, $roomtypesGroup, \PropelPDO $con)
    {
        foreach ($roomtypesGroup as $roomtypes)
        {
            foreach ($roomtypes as $roomtype)
            {
                if (is_object($roomtype) && property_exists($roomtype, 'code'))
                {
                    $objectTypeHebergement = \Cungfoo\Model\TypeHebergementQuery::create()
                        ->filterById($roomtype->code)
                        ->findOne($con)
                    ;

                    if ($objectTypeHebergement)
                    {
                        $objectEtabHasTypeHebergement = \Cungfoo\Model\EtablissementTypeHebergementQuery::create()
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
                    ->findOne()
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
                            ->findOne()
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

    protected function removeObsoleteEtabs(\PropelPDO $con)
    {
        if (count($this->etabs) > 0)
        {
            $etabQuery = \Cungfoo\Model\EtablissementQuery::create();
            foreach ($this->etabs as $etab)
            {
                $etabQuery->prune($etab);
            }

            $etabQuery->delete($con);
        }
    }
}
