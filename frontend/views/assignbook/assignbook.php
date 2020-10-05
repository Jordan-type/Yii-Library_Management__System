<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Students;
use frontend\models\Books;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBooks */
/* @var $form ActiveForm */
$students = ArrayHelper::map(Students::find()->all(), 'student_id', 'full_name');
$books = ArrayHelper::map(Books::find()->all(), 'book_id', 'book_name');

?>
<div class="assignbook">

    <?php $form = ActiveForm::begin() ?>

        <?= $form->field($model, 'student_id')->dropDownList($students) ?>
        <?= $form->field($model, 'book_id')->dropDownList($books) ?>
        <?= $form->field($model, 'borrow_date')->widget(
          DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
              'autoclose' => true,
              'format' => 'yyyy-mm-dd'
            ]
          ]); ?>
        <?= $form->field($model, 'return_date')->widget(
          DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
              'autoclose' => true,
              'format' => 'yyyy-mm-dd'
            ]
          ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- assignbook -->
