<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBooks */

$this->title = 'Create Borrowed Books';
$this->params['breadcrumbs'][] = ['label' => 'Borrowed Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowed-books-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
