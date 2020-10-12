<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Books;
use frontend\models\Students;
use frontend\models\BookSearch;
use frontend\models\BookAuthors;
use frontend\models\BorrowedBooks;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookController implements the CRUD actions for Books model.
 */
class BookController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Books();
        $bookAuthor = New BookAuthors();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

          $author_id = Yii::$app->request->post()['BookAuthors']['author_id'];
          $book_id = $model->book_id;
          if($this->bookauthors($author_id,$book_id)){
              return $this->redirect(['index']);
          }
          return $this->redirect(['create']);
        }

        return $this->render('create', [
            'model' => $model,
            'bookAuthor' => $bookAuthor
        ]);
    }
    public function actionAddauthor()
{
    $model = new \frontend\models\Authors();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate() && $model->save()) {
            // form inputs are valid, do something here
            return $this->redirect(['create']);
        }
    }

    return $this->renderAjax('addauthor', [
        'model' => $model,
    ]);
}

public function bookauthors($author_id,$book_id){
        $model = New BookAuthors();
        $data = array('BookAuthors'=>['book_id'=>$book_id,'author_id'=>$author_id]);

        if($model->load($data) && $model->save()){
            return true;
        }
        return false;
    }

    /*

    helps user to borrow books
    */

    public function actionApprovebook($id, $studentid)
    {
        $model = new Books();

        if (Yii::$app->request->post()) {
          $command = \Yii::$app->db->createCommand('UPDATE books SET status=1 WHERE book_id='.$id);
          $command->execute();
          $this->createNotification($studentid,$id);
          return $this->redirect(['index']);
        }

        return $this->renderAjax('approvebook', [
            'model' => $model,
        ]);
    }

public function createNotification($studentid, $book)
{
  $book = Books::find()->where(['book_id'=>$bbook_id])->one();
  $icon = 'fa fa-book';
  $user_id = Students::find()->where(['student_id'=>student_id])->one();
  \Yii::$app->db->createCommand()->insert('notifications', [
    'icon' => $icon,
    'user_id' => $user_id,
    'message' => 'Your request for book '.$book->book_name.' has been approved.'
  ])->execute();
  return true;
}



public function actionRequestbook()
    {
        $model = new BorrowedBooks();

        // var_dump(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          $this->afterBookRequest($model->book_id);
          // form inputs are valid, do something here
          return $this->redirect(['index']);
        }

        return $this->renderAjax('requestbook', [
            'model' => $model,
        ]);
    }

public function afterBookRequest($bookId){
  $command = \Yii::$app->db->createCommand('UPDATE books SET status=2 WHERE book_id='.$bookId);
  $command->execute();
  return true;
}
    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->book_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
