<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model frontend\models\Book */
$this->title = 'Create A Book';
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="col-lg-6">
    <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="box-body">
                 <?= $this->render('_form', [
                    'model' => $model,
                    'bookAuthor' => $bookAuthor
                ]) ?>
         	</div>
            <!-- /.box-body -->
        </div>
    </div>
