<?php

namespace Cungfoo\Lib\Resalys\Loader;

use \Cungfoo\Lib\Resalys\Loader\BaseLoader;

class RoomTypeLoader extends BaseLoader
{
    protected $roomtypes = array();

    public function load($locale = 'fr', \PropelPDO $con = null)
    {
        if ($con === null)
        {
            $con = \Propel::getConnection();
        }

        $con->beginTransaction();

        try
        {
            foreach ($this->data->roomtype as $roomtype)
            {
                $this->updateRoomType($roomtype, $locale, $con);
            }

            $this->removeObsoleteRoomTypes($con);

            $con->commit();
        }
        catch (\Exception $exception)
        {
            $con->rollBack();
            throw $exception;
        }
    }

    protected function updateRoomType($roomtype, $locale, \PropelPDO $con)
    {
        $objectRoomType = \Cungfoo\Model\TypeHebergementQuery::create()
            ->filterByCode($roomtype->{'code'})
            ->findOne($con)
        ;

        if (!$objectRoomType)
        {
            $objectRoomType = new \Cungfoo\Model\TypeHebergement();
            $objectRoomType->setCode($roomtype->{'code'});
        }

        $objectRoomType->setLocale($locale);
        $objectRoomType->setName($roomtype->{'label'});

        if (property_exists($roomtype, 'category_code'))
        {
            $roomTypeCategoryId = \Cungfoo\Model\CategoryTypeHebergementQuery::create()
                ->select(array('id'))
                ->filterByCode($roomtype->{'category_code'})
                ->findOne($con)
            ;

            $objectRoomType->setCategoryTypeHebergementId($roomTypeCategoryId);
        }

        $objectRoomType->save($con);
        $this->roomtypes[] = $objectRoomType;
    }

    protected function removeObsoleteRoomTypes(\PropelPDO $con)
    {
        if (count($this->roomtypes) > 0)
        {
            $roomTypeQuery = \Cungfoo\Model\TypeHebergementQuery::create();
            foreach ($this->roomtypes as $roomtype)
            {
                $roomTypeQuery->prune($roomtype);
            }

            $roomTypeQuery->delete($con);
        }
    }
}
