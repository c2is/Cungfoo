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
        $toDelete = array_diff($events, $this->processedIds);

        EventQuery::create()
            ->filterById($toDelete, \Criteria::NOT_IN)
            ->delete()
        ;

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
                if (!in_array($insertedEvent->getId(), $this->processedIds))
                {
                    $this->processedIds[] = $insertedEvent->getId();
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
        }
        else
        {
            if (!$newEvent)
            {
                return null;
            }

            $defaultName        = $newEvent->getName();
            $defaultStrDate     = $newEvent->getStrDate();
            $defaultSubtitle    = $newEvent->getSubtitle();
            $defaultDescription = $newEvent->getDescription();
            $defaultTransport   = $newEvent->getTransport();

            $newEvent
                ->setLocale($language)
                ->setName(($event->{'Title'}) ? $event->{'Title'} : $defaultName)
                ->setSubtitle(($event->{'Subtitle'}) ? $event->{'Subtitle'} : $defaultSubtitle)
                ->setStrDate($event->{'StrDate'} ? $event->{'StrDate'} : $defaultStrDate)
                ->setDescription(($event->{'Description'}) ? $event->{'Description'} : $defaultDescription)
                ->setTransport(($event->{'Transports'}) ? $event->{'Transports)'} : $defaultTransport)
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
