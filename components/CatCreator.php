<?php

namespace app\components;

use app\models\Cat;
use yii\db\Exception;

/** Создавать котов */
class CatCreator
{
    /**
     * @param int $count - кол-во котов
     * @throws Exception
     */
    public function create(int $count): int
    {
        $i = $count;

        while ($i > 0) {
            // create new cat
            $cat = new Cat();

            $cat->age = random_int(1, 20);
            $cat->gender = random_int(0, 1);
            //         если пол == мальчик   то     имя мальчика   иначе      девочка
            $cat->name = ($cat->gender == 1) ? Cat::getRandomName() : Cat::getRandomName(false);
            $cat->price = random_int(1, 100) * 1000;
            $cat->breed = Cat::getRandomBreed();

            // load() Дописать
//            $data = $this->getRandomData();
//            $cat->load($data);

            $cat->save(); // Сохранить/Обновить в БД - фреймворк сам знает что нужно сделать
            $i--;
        }

        return $count;
    }


    private function getRandomData()
    {
        // Дописать
    }
}