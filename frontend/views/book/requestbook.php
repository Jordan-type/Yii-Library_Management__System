<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Books;
use frontend\models\students;
use frontend\models\BorrowedBooks;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

// $bookList = Books::find()->asArray()->all();
// $bookList = ArrayHelper::map(Books::find()->orderBy('book_name')->asArray()->all() 'book_id', 'book_name'),['prompt' => 'Select books', 'multiple' => true, 'selected' => 'selected']);

/* @var $this yii\web\View */
/* @var $model frontend\models\Books */
/* @var $form ActiveForm */
$studentId = Students::find()->where(['user_id'=>Yii::$app->user->id])->one();
// var_dump($studentId);
$books = ArrayHelper::map(Books::find()->where(['status'=>0])->all(), 'book_id', 'book_name');
?>
<div class="requestbook">

    <?php $form = ActiveForm::begin(['id' => 'request-book']); ?>

        <?= $form->field($model, 'borrow_date')->hiddenInput(['value'=>date('yy/m/d')])->label(false) ?>
        <?= $form->field($model, 'student_id')->hiddenInput(['value'=>$studentId->student_id])->label(false) ?>
        <?= $form->field($model, 'book_id')->dropDownList($books) ?>
        <?= $form->field($model, 'expected_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter expected return date ...'],
        'pluginOptions' => [
            'autoclose'=>true,
            'format'=>'yyyy/mm/dd'
        ]
    ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- requestbook -->
