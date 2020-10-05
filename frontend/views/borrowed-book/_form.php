<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Books;
use frontend\models\Students;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBooks */
/* @var $form yii\widgets\ActiveForm */
$students = ArrayHelper::map(Students::find()->all(), 'student_id', 'full_name');
$books = ArrayHelper::map(Books::find()->where(['status'=>0])->all(), 'book_id', 'book_name');
?>

<div class="borrowed-books-form">

    <?php $form = ActiveForm::begin(['id' => 'Borrowed-books-create']); ?>

    <?= $form->field($model, 'borrow_date')->hiddenInput(['value'=>date('yy/m/d')])->label(false) ?>

    <?= $form->field($model, 'student_id')->dropDownList($students) ?>

    <?= $form->field($model, 'book_id')->dropDownList($books) ?>

    <?= $form->field($model, 'expected_date')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter expected return date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format'=>'yyyy/mm/dd'
    ]
]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
