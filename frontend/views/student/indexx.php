<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students list';
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="box box-info">
            <div class="box-header with-border">
              <div>
              <?= Html::a('Create Students', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div>
              <h1  style="text-align: center;"><?= Html::encode($this->title) ?></h1>
            </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'student_id',
                    'user_id',
                    'id_number',
                    'full_name',
                    'reg_number',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            </div>
            <!-- /.box-body -->
                  <!-- /.box-footer -->
          </div>
