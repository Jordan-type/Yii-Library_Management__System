<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\BorrowedBooks;
use frontend\models\Students;
use Yii;

/**
 * BorrowedBookSearch represents the model behind the search form of `frontend\models\BorrowedBooks`.
 */
class BorrowedBookSearch extends BorrowedBooks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bbook_id', 'student_id', 'book_id'], 'integer'],
            [['borrow_date', 'expected_date', 'return_date'], 'safe'],
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

        if (Yii::$app->user->can('student')){
          $student_id = Students::find()->where(['user_id'=>Yii::$app->user->id])->One();
          $query = BorrowedBooks::find()->where(['return_date'=>NULL])->andWhere(['student_id'=>$student_id->student_id]);

        }
        if (Yii::$app->user->can('librarian')){
        $query = BorrowedBooks::find()->where(['return_date'=>NULL]);
      }
        // $user_id=Yii::$app->user->identity->id;
        // $query = Event::find()->where(['author_id'=>$user_id]);

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
            'bbook_id' => $this->bbook_id,
            'student_id' => $this->student_id,
            'book_id' => $this->book_id,
            'borrow_date' => $this->borrow_date,
            'expected_date' => $this->expected_date,
            'return_date' => $this->return_date,
        ]);

        return $dataProvider;
    }
}
