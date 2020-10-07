<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Books;
use yii\helpers\ArrayHelper;

// $bookList = Books::find()->asArray()->all();
// $bookList = ArrayHelper::map(Books::find()->orderBy('book_name')->asArray()->all() 'book_id', 'book_name'),['prompt' => 'Select books', 'multiple' => true, 'selected' => 'selected']);

/* @var $this yii\web\View */
/* @var $model frontend\models\Books */
/* @var $form ActiveForm */
$books = ArrayHelper::map(Books::find()->where(['status'=>0])->all(), 'book_id', 'book_name');
?>
<div class="requestbook">

    <?php $form = ActiveForm::begin(['id' => 'request-book']); ?>

        <?= $form->field($model, 'book_name')->dropDownList($books,['disabled' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- requestbook -->
