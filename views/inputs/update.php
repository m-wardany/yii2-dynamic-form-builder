<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wardany\dform\models\DynamicFormInput */

$this->title = 'Update Input: '. $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dynamic Form Inputs', 'url' => ['index', 'id'=> $model->form_id]];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dynamic-form-input-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'validators'=> $validators,
        'list'=> $list
    ]) ?>

</div>
