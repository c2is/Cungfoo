<?php

namespace Cungfoo\Lib\ViaFrance\Loader;

use Cungfoo\Model\Event,
    Cungfoo\Model\EventQuery,
    Cungfoo\Model\EtablissementEvent,
    Cungfoo\Model\EtablissementEventQuery,
    Cungfoo\Model\RegionEvent,
    Cungfoo\Model\RegionEventQuery;

class EventLoader extends AbstractLoader
{
    protected $cache = array();

    protected $processedIds = array();

    public function init($con)
    {
        parent::init($con);

        $this->cache = array();

        $this->dbConnection->exec("SET FOREIGN_KEY_CHECKS = 0");
    }

    public function close()
    {
        $events = EventQuery::create()->select('id')->find()->toArray();
        $processedIds = array();
        foreach ($this->processedIds as $lang => $idsByLang)
        {
            $processedIds = array_merge($processedIds, $idsByLang);

            $eventsToDeactivate = EventQuery::create()
                ->filterById(array_diff($events, $idsByLang))
                ->find()
            ;

            foreach ($eventsToDeactivate as $eventToDeactivate)
            {
                $eventToDeactivate
                    ->setLocale($lang)
                    ->setActiveLocale(false)
                    ->save()
                ;

            }
        }
        
        $toDelete = array_diff($events, $processedIds);

        EventQuery::create()
            ->filterById($toDelete)
            ->delete()
        ;

        $this->dbConnection->exec("SET FOREIGN_KEY_CHECKS = 1");
    }

    public function load($etab, $data, $language)
    {
        $xml   = new \SimpleXMLElement($data);
        $cache = array();

        if (!isset($this->processedIds[$language]))
        {
            $this->processedIds[$language] = array();
        }

        foreach ($xml->{'Event'} as $event)
        {
            if ($insertedEvent = $this->insertEvent($event, $language))
            {
                if (!in_array($insertedEvent->getId(), $this->processedIds[$language]))
                {
                    $this->processedIds[$language][] = $insertedEvent->getId();
                }
                if ($language == 'de')
                {
                    $this->insertRegionRelation($etab, $insertedEvent);
                }
                else
                {
                    $this->insertRelation($etab, $insertedEvent, $event['DistanceXY']);
                }
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

        $utils = new \Cungfoo\Lib\Utils();

        $newEvent = EventQuery::create()
            ->filterByCode($code)
            ->findOne($this->dbConnection);
        ;

        if (!$newEvent)
        {
            $newEvent = new Event();
        }

        $newEvent
            ->setLocale($language)
            ->setName($event->{'Title'})
            ->setSlug($utils->slugify($event->{'Title'}))
            ->setSubtitle($event->{'Subtitle'})
            ->setStrDate($event->{'StrDate'})
            ->setCode($code)
            ->setCategory($event->{'Category'}['Id'])
            ->setPriority($event->{'Priority'})
            ->setGeoCoordinateX($event->attributes()->{'X'})
            ->setGeoCoordinateY($event->attributes()->{'Y'})
            ->setDistanceCamping($event->attributes()->{'DistanceXY'})
            ->setImage($event->{'Image1'})
            ->setDescription($event->{'Description'})
            ->setTel($event->{'Tel'})
            ->setFax($event->{'Fax'})
            ->setEmail($event->{'Email'})
            ->setWebsite($event->{'WebSite'})
            ->setTransport($event->{'Transports'})
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

    public function insertRegionRelation($region, $event)
    {
        $regionEvent = RegionEventQuery::create()
            ->filterByRegionId($region->getId())
            ->filterByEventId($event->getId())
            ->findOne($this->dbConnection)
        ;

        if (!$regionEvent)
        {
            $regionEvent = new RegionEvent();
            $regionEvent
                ->setRegionId($region->getId())
                ->setEventId($event->getId())
                ->save($this->dbConnection)
            ;
        }
    }
}
