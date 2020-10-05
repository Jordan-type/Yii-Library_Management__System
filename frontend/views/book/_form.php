<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Authors;
use yii\bootstrap\modal;

/* @var $this yii\web\View */
/* @var $model frontend\models\Books */
/* @var $form yii\widgets\ActiveForm */
$authors = ArrayHelper::map(Authors::find()->all(), 'author_id', 'author_name');

?>
<div class="row">
<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="col-xs-12">
    <?= $form->field($model, 'book_name')->textInput(['maxlength' => true, 'placeholder'=>'Enter Book Name'])->label(false) ?>
</div>
    <div class="col-xs-8">
    <?= $form->field($bookAuthor, 'author_id')->dropDownList($authors, ['placeholder'=>'Select Book Author'])->label(false) ?>
  </div>
  <div class="col-xs-4">
    <button type="button" class="btn btn-block btn-success addauthor"><i class="fa fa-plus" aria-hidden="true"></i> Add Author</button>
  </div>

<div class="col-xs-12">
    <?= $form->field($model, 'reference_number')->textInput(['maxlength' => true, 'placeholder'=>'Enter Reference Number'])->label(false) ?>
</div>
<div class="col-xs-12">
    <?= $form->field($model, 'publisher')->textInput(['maxlength' => true, 'placeholder'=>'Enter Publisher Name'])->label(false) ?>
</div>
<div class="col-xs-12">
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
    </div>
</div>

    <?php ActiveForm::end(); ?>

</div>
</div>
<?php
Modal::begin([
  'header'=>'<h4>Add Author</h4>',
  'id'=>'addauthor',
  'size'=>'modal-lg'
  ]);
echo "<div id='addauthorContent'></div>";
Modal::end();
?>
