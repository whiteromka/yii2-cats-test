<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserUniversalSearch represents the model behind the search form of `app\models\User`.
 */
class UserUniversalSearch extends User
{
    /** For passport */
    /** @var int - Связанная колонка из паспорта */
    public $number;

    /** @var string - Связанная колонка из паспорта */
    public $country;

    /** For car */
    /** @var string - Связанная колонка из машины  */
    public $carName;

    /** @var string - Связанная колонка из машины  */
    public $mark;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'car_id', 'gender', 'status_id'], 'integer'],
            [['name', 'last_name', 'email', 'password_hash', 'created_at', 'updated_at'], 'safe'],
            [['number', 'country'], 'safe'],
            [['carName', 'mark'], 'safe'],
        ];
    }

    public function attributeLabels() {
        $oldFields = parent::attributeLabels();
        $newFields = [
            'number' => 'Номер',
            'country' => 'Страна',
            'carName' => 'Название бренда машины',
            'mark' => 'Марка машины'
        ];
        return array_merge($oldFields, $newFields);
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        // ->joinWith('passport');
        $query = User::find()->joinWith(['passport', 'car']); // tables: user, passport
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort' => [
                'defaultOrder' => [
                    'status_id' => SORT_ASC,
                    'id' => SORT_ASC
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Поиск по поль-ям
        $query->andFilterWhere([
            'user.id' => $this->id,
            'gender' => $this->gender,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'name', trim($this->name)])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'email', $this->email]);

        // tables: user, passport
        // Поиск по паспортам
        $query->andFilterWhere([
            'passport.number' => $this->number
        ]);
        $query->andFilterWhere(['like', 'passport.country', $this->country]);

        // Поиск по машинам
        $query->andFilterWhere([
            'car.name' => $this->carName,
            'car.mark' => $this->mark
        ]);

        return $dataProvider;
    }
}
