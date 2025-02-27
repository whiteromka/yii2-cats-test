<?php

namespace app\components;

use app\models\Cat;
use yii\db\Exception;

/** Создавать котов */
class UserCreator implements Creator
{
    private int $countErrors = 0;
    private int $countSuccess = 0;
    /** @var array - Массив успешно сох-ых имен котов */
    private array $successCatNames = [];

    /** @var array ['Myrzik' => 'Слишком короткое имя', 'Машка' => '...'] */
    private array $errorsCatNames = [];

    private array $badCats = [];

    /**
     * Результат работы
     *
     * @return []
     */
    public function getInfo(): array
    {
        return [
            'countErrors' => $this->countErrors,
            'countSuccess' => $this->countSuccess,
            'successCatNames' => $this->successCatNames,
            'errorsCatNames' => $this->errorsCatNames,
            'badCats' => $this->badCats,
        ];
    }

    /**
     * Вернет кол-во успешно сохраненных котов
     *
     * @param int $count - кол-во котов
     * @return ['errors' => 12, 'success' => 2000]
     * @throws Exception
     */
    public function create(int $count): void
    {
        // ....
    }

    /**
     *  Создает рандомные данные для кота
     */
    private function getRandomData(): array
    {
        $age = random_int(1, 20);
        $gender = random_int(0, 1);
        $name = ($gender == 1) ? self::getRandomName() : self::getRandomName(false);
        $price = random_int(1, 100) * 1000;
        $breed = self::getRandomBreed();

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

    /** Этот метод нужно вынести в CatCreator
     * Получить случайное котоимя
     */
    public static function getRandomName($isBoy = true): string
    {
        $boys = [
            'Ethan', 'Liam', 'Noah', 'Lucas', 'Oliver', 'Benjamin', 'Logan', 'William', 'Alexander', 'Elijah',
            'James', 'Gabriel', 'Michael', 'Daniel', 'Anthony', 'Christopher', 'Joshua', 'Mason', 'Andrew', 'Samuel',
            'Julian', 'Owen', 'Caleb', 'Jaxon', 'Hunter', 'Landon', 'Aiden', 'Gavin', 'Cameron', 'Cooper'
        ];

        $gils = [
            'Emma', 'Olivia', 'Ava', 'Sophia', 'Mia', 'Isabella', 'Charlotte', 'Amelia', 'Harper', 'Evelyn',
            'Abigail', 'Emily', 'Hannah', 'Madison', 'Victoria', 'Jessica', 'Samantha', 'Avery', 'Riley', 'Zoe',
            'Lily', 'Grace', 'Natalie', 'Savannah', 'Julia', 'Peyton', 'Hailey', 'Kayla', 'Sarah', 'Lauren',
        ];

        if ($isBoy) {
            $key = array_rand($boys);
            return $boys[$key];
        } else {
            $key = array_rand($gils);
            return $gils[$key];
        }
    }

    /** Этот метод нужно вынести в CatCreator
     *  Вернет случайную котопороду
     */
    public static function getRandomBreed(): string
    {
        $breeds = ['Британская короткошёрстная', 'Сиамская', 'Абиссинская', 'Персидская'];
        $key = array_rand($breeds);
        return $breeds[$key];
    }
}