<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $notification_id
 * @property string $icon
 * @property int $user_id
 * @property string $message
 *
 * @property User $user
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icon', 'user_id', 'message'], 'required'],
            [['user_id'], 'integer'],
            [['icon'], 'string', 'max' => 50],
            [['message'], 'string', 'max' => 200],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'notification_id' => 'Notification ID',
            'icon' => 'Icon',
            'user_id' => 'User ID',
            'message' => 'Message',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
