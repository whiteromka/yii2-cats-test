<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cat;

/**
 * CatSearch represents the model behind the search form of `app\models\Cat`.
 */
class CatSearch extends Cat
{
    //public $aaa2;

    /**
     * Правила валидации для поиска
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age', 'price', 'gender'], 'integer'],
            [['name', 'breed', ], 'safe'],
            //[['gender',], 'safe'],
            //[['aaa2',], 'safe'],
        ];
    }

    /**
     * Метод сценариев.
     *
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Метод поиска. Он у всех поисковых моделей практически одинаковый
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        // Пример получения сущности кота:
        // $cat = Cat::find()->where(['name' => 'Myrzik'])->one();  // тут Кот (объект Cat)

        // тут не кот!!! тут запрос на получение кота
        // тут запрос к БД (объект запроса к БД ActiveQuery\Query)
        $query = Cat::find(); // соответствует примерно этому SQL: select * from 'cat';

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        // После выполнения этой строки данные из формы будут загружены в поисковую модель т.е. в $this
        // т.е. в $this->name, $this->age итд будут те значения что вписали в поисковую форму
        $this->load($params);
        // $name = $this->name; // Vasya (то что прилетело из формы)
        // $age = $this->age; // (то что прилетело из формы)

        // Если произошла ошибка валидация этой поисковой модели то просто вернем всех котов
        if (!$this->validate()) {
            return $dataProvider;
        }

        // если используем andFilterWhere(...) то все параметры подставятся в sql запрос
        // только в том случае если параметры были в форме(не пустыми)
        $query->andFilterWhere([
            'id' => $this->id, // sql... and id = <idForm> только если id был в форме, если его не было это строка не отработает
            'age' => $this->age, // sql... and age = <ageForm> только если age был в форме, ...
            'gender' => $this->gender, // тоже самое
            'price' => $this->price,
        ]);
        //SQL: select * from 'cat' where id = <idForm> and age = <ageForm> and .....

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'breed', $this->breed]);
           // ->andFilterWhere(['like', 'age', $this->age]);
           //SQL: select * from 'cat' where ... and name like "% <nameFomr> %" ...

        return $dataProvider;
    }
}
