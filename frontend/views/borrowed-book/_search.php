<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrowed-books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bbook_id') ?>

    <?= $form->field($model, 'student_id') ?>

    <?= $form->field($model, 'book_id') ?>

    <?= $form->field($model, 'borrow_date') ?>

    <?= $form->field($model, 'expected_date') ?>

    <?php // echo $form->field($model, 'return_date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
