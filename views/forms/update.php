<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wardany\dform\models\DynamicForm */

$this->title = 'Update Dynamic Form: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Dynamic Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dynamic-form-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
