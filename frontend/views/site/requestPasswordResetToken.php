<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-box">
<div class="site-request-password-reset">
    <h1 class="login-box-msg" ><?= Html::encode($this->title) ?></h1>

    <p class="login-box-msg">Please fill out your email. A link to reset password will be sent to your email.</p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <div class="col-lg-8">
              <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' =>'Please input your email'])->label(false) ?>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                  <?= Html::submitButton('Send <i class="fa fa-paper-plane"></i>', ['class' => 'btn btn-primary']) ?>
              </div>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="col-lg-12">
              <a href="<?= Url::to('login') ?>" class="btn btn-block btn-success" aria-hidden="true">Go Back</a>
            </div>
        </div>
    </div>
</div>
</div>
