<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "students".
 *
 * @property int $student_id
 * @property int $user_id
 * @property int $id_number
 * @property string $full_name
 * @property string $reg_number
 *
 * @property BorrowedBooks[] $borrowedBooks
 * @property User $user
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'id_number', 'full_name', 'reg_number'], 'required'],
            [['user_id', 'id_number'], 'integer'],
            [['full_name', 'reg_number'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'user_id' => 'User ID',
            'id_number' => 'Id Number',
            'full_name' => 'Full Name',
            'reg_number' => 'Reg Number',
        ];
    }

    /**
     * Gets query for [[BorrowedBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowedBooks()
    {
        return $this->hasMany(BorrowedBooks::className(), ['student_id' => 'student_id']);
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
