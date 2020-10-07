<?php

namespace frontend\controllers;

use Yii;
use frontend\models\BorrowedBooks;
use frontend\models\BorrowedBookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BorrowedBookController implements the CRUD actions for BorrowedBooks model.
 */
class BorrowedBookController extends Controller
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
     * Lists all BorrowedBooks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BorrowedBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BorrowedBooks model.
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
     * Creates a new BorrowedBooks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BorrowedBooks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          if($this->bookUpdate($model->book_id)){
               return $this->redirect(['index']);
           }
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    public function bookUpdate($bookId){
      $command = \Yii::$app->db->createCommand('UPDATE books SET status=1 WHERE book_id='.$bookId);
        $command->execute();
        return true;
    }

    public function actionReturnbook($id){

            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $this->updateAfterDelete($model->book_id);
                return $this->redirect(['index']);
            }

            return $this->renderAjax('returnbook',[
                'model'=>$model,
            ]);
        }

    /**
     * Updates an existing BorrowedBooks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->bbook_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BorrowedBooks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $bookId = BorrowedBooks::find()->where(['bbook_id'=>$id])->one();
        $this->findModel($id)->delete();
        $this->updateAfterDelete($bookId->book_id);

        return $this->redirect(['index']);
    }

    public function updateAfterDelete($bookId){
      $command = \Yii::$app->db->createCommand('UPDATE books SET status=0 WHERE book_id='.$bookId);
      $command->execute();
      return true;
    }

    /**
     * Finds the BorrowedBooks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BorrowedBooks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BorrowedBooks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
