<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use yii\helpers\ArrayHelper;

/**
 * UserPassportSearch represents the model behind the search form of `app\models\User`.
 */
class UserPassportSearch extends User
{
    /** @var int - Связанная колонка из паспорта */
    public $number;

    /** @var string - Связанная колонка из паспорта */
    public $country;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'car_id', 'gender', 'status_id'], 'integer'],
            [['name', 'last_name', 'email', 'password_hash', 'created_at', 'updated_at'], 'safe'],
            [['number', 'country'], 'safe'],
        ];
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
        $query = User::find()->joinWith('passport');// tables: user, passport
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
//            'sort' => [
//                'defaultOrder' => [
//                    'created_at' => SORT_DESC,
//                    'title' => SORT_ASC,
//                ]
//            ],
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

        return $dataProvider;
    }
}
