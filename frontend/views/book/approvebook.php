<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Books;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model frontend\models\Book */
/* @var $form ActiveForm */
$books = ArrayHelper::map(Books::find()->where(['status'=>2])->all(), 'book_id', 'book_name');
?>
<div class="approvebook">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'book_name')->dropDownList($books) ?>

    
        <div class="form-group">
            <?= Html::submitButton('Approve Book', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div><!-- approvebook -->
