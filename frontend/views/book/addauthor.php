<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Authors */
/* @var $form ActiveForm */
?>
<div class="addauthor">

    <?php $form = ActiveForm::begin([
        'action' =>['book/addauthor'],
         'method'=>'post',
         'id'=>'addauthor'
      ]
    ); ?>

        <?= $form->field($model, 'author_name') ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- addauthor -->
