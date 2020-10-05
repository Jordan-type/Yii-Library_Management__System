<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBooks */

$this->title = 'Update Borrowed Books: ' . $model->bbook_id;
$this->params['breadcrumbs'][] = ['label' => 'Borrowed Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bbook_id, 'url' => ['view', 'id' => $model->bbook_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="borrowed-books-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
