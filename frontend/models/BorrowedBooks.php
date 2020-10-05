<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "borrowed_books".
 *
 * @property int $bbook_id
 * @property int $student_id
 * @property int $book_id
 * @property string $borrow_date
 * @property string $expected_date
 * @property string|null $return_date
 *
 * @property Books $book
 * @property Students $student
 */
class BorrowedBooks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrowed_books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'book_id', 'borrow_date', 'expected_date'], 'required'],
            [['student_id', 'book_id'], 'integer'],
            [['borrow_date', 'expected_date', 'return_date'], 'safe'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::className(), 'targetAttribute' => ['book_id' => 'book_id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_id' => 'student_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bbook_id' => 'Bbook ID',
            'student_id' => 'Student ID',
            'book_id' => 'Book ID',
            'borrow_date' => 'Borrow Date',
            'expected_date' => 'Expected Date',
            'return_date' => 'Return Date',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['book_id' => 'book_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['student_id' => 'student_id']);
    }
}
