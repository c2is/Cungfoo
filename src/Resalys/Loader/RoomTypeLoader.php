<?php

namespace Resalys\Loader;

use \Resalys\Loader\BaseLoader;

class RoomTypeLoader extends BaseLoader
{
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
                $objectRoomType = \Cungfoo\Model\TypeHebergementQuery::create()
                    ->filterById($roomtype->code)
                    ->findOne($con)
                ;

                if (!$objectRoomType)
                {
                    $objectRoomType = new \Cungfoo\Model\TypeHebergement();
                    $objectRoomType->setId($roomtype->code);
                }

                $objectRoomType->setLocale($locale);
                $objectRoomType->setName($roomtype->label);

                if (property_exists($roomtype, 'category_code'))
                {
                    $objectRoomType->setCategoryTypeHebergementId($roomtype->category_code);
                }

                $objectRoomType->save($con);
            }

            $con->commit();
        }
        catch (\Exception $exception)
        {
            $con->rollBack();
            throw $exception;
        }
    }
}
