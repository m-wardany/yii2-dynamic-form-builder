<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model wardany\dform\models\DynamicFormInput */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dynamic Form Inputs', 'url' => ['index', 'id'=> $model->form_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dynamic-form-input-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'form.title',
            'inputType',
            'name',
            'label',
            'html_attributes_options',
            'validation_rules',
        ],
    ]) ?>

</div>
