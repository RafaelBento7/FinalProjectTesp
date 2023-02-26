<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "manager".
 *
 * @property int $manager_id
 * @property int $restaurant_id
 *
 * @property User $user
 * @property Restaurant $restaurant
 */
class Manager extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%manager}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manager_id', 'restaurant_id'], 'required'],
            [['manager_id', 'restaurant_id'], 'integer'],
            ['manager_id', 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'boolean'],
            ['manager_id', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['manager_id' => 'id']],
            ['restaurant_id', 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::class, 'targetAttribute' => ['restaurant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'manager_id' => 'ID do Gerente',
            'restaurant_id' => 'ID do Restaurante',
        ];
    }

    /**
     * Gets query for [[Manager]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'manager_id']);
    }

    /**
     * Gets query for [[Restaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }
}
