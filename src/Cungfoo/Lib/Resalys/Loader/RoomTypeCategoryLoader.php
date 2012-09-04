<?php

namespace Cungfoo\Lib\Resalys\Loader;

use \Cungfoo\Lib\Resalys\Loader\BaseLoader;

class RoomTypeCategoryLoader extends BaseLoader
{
    protected $roomtypeCategories = array();

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
                $this->updateRoomTypeCategory($category, $locale, $con);
            }

            $this->removeObsoleteRoomTypeCategories($con);

            $con->commit();
        }
        catch (\Exception $exception)
        {
            $con->rollBack();
            throw $exception;
        }
    }

    protected function updateRoomTypeCategory($category, $locale, $con)
    {
        $objectRoomTypeCategory = \Cungfoo\Model\CategoryTypeHebergementQuery::create()
            ->filterById($category->{'category_code'})
            ->findOne($con)
        ;

        if (!$objectRoomTypeCategory)
        {
            $objectRoomTypeCategory = new \Cungfoo\Model\CategoryTypeHebergement();
            $objectRoomTypeCategory->setId($category->{'category_code'});
        }

        $objectRoomTypeCategory->setLocale($locale);
        $objectRoomTypeCategory->setName($category->{'category_label'});

        $objectRoomTypeCategory->save($con);
        $this->roomtypes[$objectRoomTypeCategory->getId()] = $objectRoomTypeCategory;
    }

    protected function removeObsoleteRoomTypeCategories(\PropelPDO $con)
    {
        if (count($this->roomtypeCategories) > 0)
        {
            $roomTypeCategoriesQuery = \Cungfoo\Model\CategoryTypeHebergementQuery::create();
            foreach ($this->roomtypeCategories as $category)
            {
                $roomTypeCategoriesQuery->prune($category);
            }

            $roomTypeCategoriesQuery->delete($con);
        }
    }
}
