<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $book_id
 * @property string $book_name
 * @property string $reference_number
 * @property string $publisher
 * @property int $status Status 0 rep available, status 1 rep issued, status 2 rep pending
 *
 * @property BookAuthors[] $bookAuthors
 * @property BorrowedBooks[] $borrowedBooks
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_name', 'reference_number', 'publisher'], 'required'],
            [['status'], 'integer'],
            [['book_name'], 'string', 'max' => 100],
            [['reference_number', 'publisher'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'book_id' => 'Book ID',
            'book_name' => 'Book Name',
            'reference_number' => 'Reference Number',
            'publisher' => 'Publisher',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthors::className(), ['book_id' => 'book_id']);
    }

    /**
     * Gets query for [[BorrowedBooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrowedBooks()
    {
        return $this->hasMany(BorrowedBooks::className(), ['book_id' => 'book_id']);
    }
}
