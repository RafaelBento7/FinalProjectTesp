<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $admin_id
 *
 * @property User $user
 */
class Admin extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['admin_id', 'required'],
            ['admin_id', 'integer'],
            ['admin_id', 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'boolean'],
            ['admin_id', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['admin_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'ID do Admin',
        ];
    }

    /**
     * Gets query for [[Admin]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'admin_id']);
    }
}
