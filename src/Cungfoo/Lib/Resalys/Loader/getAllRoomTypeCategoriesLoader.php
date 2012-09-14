<?php

namespace Cungfoo\Lib\Resalys\Loader;

use Cungfoo\Lib\Resalys\Loader\BaseLoader,
    Cungfoo\Model\CategoryTypeHebergementQuery,
    Cungfoo\Model\CategoryTypeHebergement;

class getAllRoomTypeCategoriesLoader extends BaseLoader
{
    public function load($data, $locale, \PropelPDO $con)
    {
        try
        {
            $roomTypeCategoriesQuery = CategoryTypeHebergementQuery::create();
            foreach ($data->{'roomtype_category'} as $category)
            {
                $objectRoomTypeCategory = $this->updateRoomTypeCategory($category, $locale, $con);
                $roomTypeCategoriesQuery->prune($objectRoomTypeCategory);
            }

            $roomTypeCategoriesQuery->delete($con);
        }
        catch (\Exception $exception)
        {
            throw $exception;
        }
    }

    protected function updateRoomTypeCategory($category, $locale, \PropelPDO $con)
    {
        $objectRoomTypeCategory = CategoryTypeHebergementQuery::create()
            ->filterByCode($category->{'category_code'})
            ->findOne($con)
        ;

        if (!$objectRoomTypeCategory)
        {
            $objectRoomTypeCategory = new CategoryTypeHebergement();
            $objectRoomTypeCategory->setCode($category->{'category_code'});
        }

        $objectRoomTypeCategory->setLocale($locale);
        $objectRoomTypeCategory->setName($category->{'category_label'});

        $objectRoomTypeCategory->save($con);
        return $objectRoomTypeCategory;
    }
}
