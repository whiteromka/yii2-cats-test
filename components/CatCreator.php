<?php

namespace app\components;

use app\models\Cat;
use yii\db\Exception;

/** Создавать котов */
class CatCreator
{
    /**
     * Вернет кол-во успешно сохраненных котов
     *
     * @param int $count - кол-во котов
     * @return ['errors' => 12, 'success' => 2000]
     * @throws Exception
     */
    public function create(int $count): array
    {
        $result = ['errors' => 0, 'success' => 0];
        while ($count > 0) {
            $cat = new Cat();
            $dataCat = $this->getRandomData();
            $cat->load($dataCat);
            /** @var bool $currentCatSaveResult - true/false т.е. успешно сохранили кота или кот не сохранился */
            $currentCatSaveResult = $cat->save(); // Сохранить/Обновить в БД - фреймворк сам знает что нужно сделать
            if ($currentCatSaveResult) {
                $result['success']++;
            } else {
                $result['errors']++;
            }
            $count--;
        }
        return $result;
    }

    /**
     *  Создает рандомные данные для кота
     */
    private function getRandomData(): array
    {
        $age = random_int(1, 20);
        $gender = random_int(0, 1);
        $name = ($gender == 1) ? Cat::getRandomName() : Cat::getRandomName(false);
        $price = random_int(1, 100) * 1000;
        $breed = Cat::getRandomBreed();

        return [
            'Cat' => [
                'age' => $age,
                'gender' => $gender,
                'name' => $name,
                'price' => $price,
                'breed' => $breed,
            ]
        ];
    }
}