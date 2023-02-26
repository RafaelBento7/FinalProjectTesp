<?php

namespace common\models;

use common\models\RestaurantItem;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RestaurantItemSearch represents the model behind the search form of `common\models\RestaurantItem`.
 */
class RestaurantItemSearch extends RestaurantItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state', 'restaurant_id'], 'integer'],
            [['item', 'image'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        //$query = RestaurantItem::find();
        $query = RestaurantItem::find()->where(['restaurant_id'=>$params['restaurant_id']]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'state' => $this->state,
            'restaurant_id' => $this->restaurant_id,
        ]);

        $query->andFilterWhere(['like', 'item', $this->item])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
