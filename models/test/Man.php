<?php

namespace app\models\test;

class Man
{
    public int $id;
    public string $name;
    public int $age;

    /**
     * Получить все чем болел конкретный человек за всю свою историю
     *
     * @return array
     */
    public function getMyDiseases(): array
    {
        $allDisesases = self::getAllDiseases();
        $specialD = $allDisesases[124325];
        $diseases = Diseases::find()
            ->where(['person_id' => $this->id])->all();
        $diseases[124325] = $specialD;
        return $diseases;
    }

    /**
     * Получить вообще все болезни которые могут быть у человека
     *
     * @return array
     */
    public static function getAllDiseases(): array
    {
        $diseases = Diseases::find()->all();
        return $diseases;
    }
}