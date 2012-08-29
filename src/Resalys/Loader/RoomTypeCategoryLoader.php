<?php

namespace Resalys\Loader;

use \Resalys\Loader\BaseLoader;

class RoomTypeCategoryLoader extends BaseLoader
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
            foreach ($this->data->roomtype_category as $category)
            {
                $objectRoomTypeCategory = \Cungfoo\Model\CategoryTypeHebergementQuery::create()
                    ->filterById($category->category_code)
                    ->findOne($con)
                ;

                if (!$objectRoomTypeCategory)
                {
                    $objectRoomTypeCategory = new \Cungfoo\Model\CategoryTypeHebergement();
                    $objectRoomTypeCategory->setId($category->category_code);
                }

                $objectRoomTypeCategory->setLocale($locale);
                $objectRoomTypeCategory->setName($category->category_label);
                $objectRoomTypeCategory->save($con);
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
