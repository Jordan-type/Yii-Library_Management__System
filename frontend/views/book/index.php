<?php

use yii\bootstrap\modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use frontend\models\Books;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books List';
$this->params['breadcrumbs'][] = $this->title;
?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="box box-info">
            <div class="box-header with-border">
              <div>
                <?php if(Yii::$app->user->can('librarian')){ ?>
              <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
            <?php }?>
            <?php if(Yii::$app->user->can('student')){ ?>

            <?php }?>
            </div>
            <div style="text-align: center;">
              <h1><?= Html::encode($this->title) ?></h1>
            </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
             <div class="box-body">
               <?php if(Yii::$app->user->can('librarian')){ ?>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'book_id',
                    'book_name',
                    'reference_number',
                    'publisher',
                    // 'status',
                    [
                      'label'=>'Book Status',
                      'format' => 'raw',
                      'value' => function ($dataProvider) {
                        $bookstatus = Books::find()->where(['book_id'=>$dataProvider->book_id])->one();
                        if($bookstatus->status == 0){
                          $status = 'Available';
                          return '<span class="btn btn-info">'.$status.'</span>';
                        }elseif ($bookstatus->status == 1) {
                          $status = 'Issued';
                          return '<span class="btn btn-success">'.$status.'</span>';
                        }elseif ($bookstatus->status == 2) {
                          $status = 'Pending';
                          // return Html::a('Approve', ['approve','id'=>$dataProvider->book_id,'studentId'=>$dataProvider->student_id], ['class' => 'btn btn-success']);
                          return '<span val="'.$dataProvider->book_id.'" class="btn btn-danger approvebook">'.$status.'</span>';
                        }
                      // return '<span class="btn btn-info">'.$status.'</span>';
                        },
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
          </div>
          <?php }?>
          <?php if(Yii::$app->user->can('student')){ ?>
          <div class="box-body">
         <?php Pjax::begin(); ?>
         <?= GridView::widget([
             'dataProvider' => $dataProvider,
             'filterModel' => $searchModel,
             'columns' => [
                 ['class' => 'yii\grid\SerialColumn'],

                 // 'book_id',
                 'book_name',
                 'reference_number',
                 'publisher',
                 [
                   'label'=>'Book Status',
                   'format' => 'raw',
                   'value' => function ($dataProvider) {
                     $bookstatus = Books::find()->where(['book_id'=>$dataProvider->book_id])->one();
                     if($bookstatus->status == 0){
                       $status = 'Available';
                       return '<span class="btn btn-info">'.$status.'</span>';
                     }elseif ($bookstatus->status == 1) {
                       $status = 'Issued';
                       return '<span class="btn btn-success">'.$status.'</span>';
                     }elseif ($bookstatus->status == 2) {
                       $status = 'Pending';
                       return '<span class="btn btn-danger">'.$status.'</span>';
                     }
                   // return '<span class="btn btn-info">'.$status.'</span>';
                     },
                 ],
                 [
                   'label'=>'Borrow Book',
                   'format' => 'raw',
                   'value' => function ($dataProvider) {
                   return '<span val='.$dataProvider->book_id.' class="btn btn-success requestbook">Borrow Book</span>';
                     },
                 ],

                 ['class' => 'yii\grid\ActionColumn'],
             ],
         ]); ?>
         <?php Pjax::end(); ?>
       </div>
       <?php }?>
            </div>
            <!-- /.box-body -->
          </div>
          <?php
          Modal::begin([
            'header'=>'<h4>Request Book</h4>',
            'id'=>'requestbook',
            'size'=>'modal-md'
            ]);
          echo "<div id='requestbookContent'></div>";
          Modal::end();
          ?>
          <?php
          Modal::begin([
            'header'=>'<h4>Approve Book</h4>',
            'id'=>'approvebook',
            'size'=>'modal-md'
            ]);
          echo "<div id='approvebookContent'></div>";
          Modal::end();
          ?>
