<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form of `common\models\Employee`.
 */
class EmployeeSearch extends Employee
{

    public $user_username;
    public $user_fullname;
    public $user_phone_country_code;
    public $user_phone;
    public $user_email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'function_id'], 'integer'],
            [['tin', 'num_emp', 'ssn', 'street', 'zip_code', 'iban', 'qualifications'], 'safe'],
            [['user_username', 'user_fullname', 'user_phone_country_code', 'user_phone', 'user_email'], 'safe'],
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
        $query = Employee::find();

        // https://www.yiiframework.com/wiki/653/displaying-sorting-and-filtering-model-relations-on-a-gridview
        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['user_username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        /**
         * //https://www.yiiframework.com/wiki/621/filter-sort-by-calculatedrelated-fields-in-gridview-yii-2-0
         * Scenario 1
         */
        $dataProvider->sort->attributes['user_fullname'] = [
            'asc' => ['user.first_name' => SORT_ASC, 'user.last_name' => SORT_ASC],
            'desc' => ['user.first_name' => SORT_DESC, 'user.last_name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user_phone_country_code'] = [
            'asc' => ['user.phone_country_code' => SORT_ASC],
            'desc' => ['user.phone_country_code' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user_phone'] = [
            'asc' => ['user.phone' => SORT_ASC],
            'desc' => ['user.phone' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['user_email'] = [
            'asc' => ['user.email' => SORT_ASC],
            'desc' => ['user.email' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'employee_id' => $this->employee_id,
            'function_id' => $this->function_id,
        ]);

        $query->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'num_emp', $this->num_emp])
            ->andFilterWhere(['like', 'ssn', $this->ssn])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'iban', $this->iban])
            ->andFilterWhere(['like', 'qualifications', $this->qualifications])


            ->andFilterWhere(['like', 'user.username', $this->user_username])

            ->andFilterWhere([
                'or',
                ['like', 'user.first_name', $this->user_fullname],
                ['like', 'user.last_name', $this->user_fullname]
            ])

            ->andFilterWhere(['like', 'user.phone_country_code', $this->user_phone_country_code])
            ->andFilterWhere(['like', 'user.phone', $this->user_phone])
            ->andFilterWhere(['like', 'user.email', $this->user_email]);

        return $dataProvider;
    }
}
