<?php

namespace frontend\controllers;

// use Yii;

class AssignbookController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAssignbook()
{
    $model = new \frontend\models\BorrowedBooks();

    if ($model->load(\Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['site/index']);
    }

    return $this->renderAjax('assignbook', [
        'model' => $model,
    ]);
  }

}
