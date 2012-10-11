<?php

namespace Cungfoo\Lib\ViaFrance\Loader;

use Cungfoo\Model\Event,
    Cungfoo\Model\EventQuery,
    Cungfoo\Model\EtablissementEvent,
    Cungfoo\Model\EtablissementEventQuery;

class EventLoader extends AbstractLoader
{
    protected $cache = array();

    public function init($con)
    {
        parent::init($con);

        $this->cache = array();

        $this->dbConnection->exec("SET FOREIGN_KEY_CHECKS = 0");
        $this->dbConnection->exec("TRUNCATE TABLE `etablissement_event`");
        $this->dbConnection->exec("TRUNCATE TABLE `event_i18n`");
        $this->dbConnection->exec("TRUNCATE TABLE `event`");
    }

    public function close()
    {
        $this->dbConnection->exec("SET FOREIGN_KEY_CHECKS = 1");
    }

    public function load($etab, $data, $language)
    {
        $xml   = new \SimpleXMLElement($data);
        $cache = array();

        foreach ($xml->{'Event'} as $event)
        {
            if ($insertedEvent = $this->insertEvent($event, $language))
            {
                $this->insertRelation($etab, $insertedEvent, $event['DistanceXY']);
            }
        }
    }

    public function insertEvent($event, $language)
    {
        $code = (string) $event['Id'];

        if (isset($this->cache[$code][$language]))
        {
            return $this->cache[$code][$language];
        }

        $newEvent = EventQuery::create()
            ->filterByCode($code)
            ->findOne($this->dbConnection);
        ;

        if ($language == 'fr')
        {
            if ($newEvent)
            {
                return $newEvent;
            }

            $newEvent = new Event();
            $newEvent
                ->setLocale($language)
                ->setName($event->{'Title'})
                ->setStrDate($event->{'StrDate'})
                ->setCode($code)
                ->setCategory($event->{'Category'}['Id'])
                ->setPriority($event->{'Priority'})
                ->setGeoCoordinateX($event->attributes()->{'X'})
                ->setGeoCoordinateY($event->attributes()->{'Y'})
                ->setImage($event->{'Image1'})
            ;

            if ($place = $event->{'Place'})
            {
                $newEvent
                    ->setAddress($place->{'Address'})
                    ->setAddress2($place->{'Address2'})
                    ->setZipcode($place->{'ZipCode'})
                    ->setCity($place->{'City'})
                ;
            }
        }
        else
        {
            if (!$newEvent)
            {
                return null;
            }

            $defaultName    = $newEvent->getName();
            $defaultStrDate = $newEvent->getStrDate();

            $newEvent
                ->setLocale($language)
                ->setName(($event->{'Title'}) ? $event->{'Title'} : $defaultName)
                ->setStrDate($event->{'StrDate'} ? $event->{'StrDate'} : $defaultStrDate)
            ;
        }

        $newEvent->save($this->dbConnection);

        $this->cache[$code][$language] = $newEvent;

        return $newEvent;
    }

    public function insertRelation($etab, $event, $distance)
    {
        $etabEvent = EtablissementEventQuery::create()
            ->filterByEtablissementId($etab->getId())
            ->filterByEventId($event->getId())
            ->findOne($this->dbConnection)
        ;

        if (!$etabEvent)
        {
            $etabEvent = new EtablissementEvent();
            $etabEvent
                ->setEtablissementId($etab->getId())
                ->setEventId($event->getId())
                ->setDistance($distance)
                ->save($this->dbConnection)
            ;
        }
    }
}
