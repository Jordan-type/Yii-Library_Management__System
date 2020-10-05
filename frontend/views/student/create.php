<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Students */

$this->title = 'Create Students';
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
  <div class="col-lg-6">
    <div class="box box-success">
      <div class="box-header with-border">
      <h1 class="box-title"><?= Html::encode($this->title) ?></h1>
    </div>

        <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
      </div>
      <!-- /.box-body -->

    </div>
  </div>
