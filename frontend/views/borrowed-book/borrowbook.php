<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Students;
use frontend\models\Books;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBook */
/* @var $form yii\widgets\ActiveForm */
$sudents = ArrayHelper::map(Students::find()->all(), 'student_id', 'full_name');
$books = ArrayHelper::map(Books::find()->where(['status'=>0])->all(), 'book_id', 'book_name');
?>
<div class="borrowed-book-form">
    <?php $form = ActiveForm::begin(['id' => 'bb-create']); ?>


    <?= $form->field($model, 'student_id')->dropDownList($sudents,['disabled' => true]) ?>
    <?= $form->field($model, 'book_id')->dropDownList($books,['disabled' => true]) ?>

    <?= $form->field($model, 'borrow_date')->textInput(['disabled' => true]) ?>
    <?= $form->field($model, 'expected_date')->textInput(['disabled' => true]) ?>
     <?= $form->field($model, 'return_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Enter book return date ...'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format'=>'yyyy/mm/dd'
            ]
        ]);
     ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
