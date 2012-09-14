<?php

namespace Cungfoo\Lib\Resalys\Loader;

use Cungfoo\Lib\Resalys\Loader\BaseLoader,
    Cungfoo\Model\TypeHebergementQuery,
    Cungfoo\Model\TypeHebergement,
    Cungfoo\Model\CategoryTypeHebergementQuery;

class getAllRoomTypesLoader extends BaseLoader
{
    public function load($data, $locale, \PropelPDO $con)
    {
        try
        {
            $roomTypeQuery = TypeHebergementQuery::create();
            foreach ($data->roomtype as $roomtype)
            {
                $objectRoomType = $this->updateRoomType($roomtype, $locale, $con);
                $roomTypeQuery->prune($objectRoomType);
            }

            $roomTypeQuery->delete($con);
        }
        catch (\Exception $exception)
        {
            throw $exception;
        }
    }

    protected function updateRoomType($roomtype, $locale, \PropelPDO $con)
    {
        $objectRoomType = TypeHebergementQuery::create()
            ->filterByCode($roomtype->{'code'})
            ->findOne($con)
        ;

        if (!$objectRoomType)
        {
            $objectRoomType = new TypeHebergement();
            $objectRoomType->setCode($roomtype->{'code'});
        }

        $objectRoomType->setLocale($locale);
        $objectRoomType->setName($roomtype->{'label'});

        if (property_exists($roomtype, 'category_code'))
        {
            $roomTypeCategoryId = CategoryTypeHebergementQuery::create()
                ->select(array('id'))
                ->filterByCode($roomtype->{'category_code'})
                ->findOne($con)
            ;

            $objectRoomType->setCategoryTypeHebergementId($roomTypeCategoryId);
        }

        $objectRoomType->save($con);

        return $objectRoomType;
    }
}
