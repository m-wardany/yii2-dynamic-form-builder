<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model wardany\dform\models\DynamicFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dynamic-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'note') ?>

    <?= $form->field($model, 'extra_validation_rules') ?>

    <?= $form->field($model, 'custom_form_file') ?>

    <?php // echo $form->field($model, 'custom_search_file') ?>

    <?php // echo $form->field($model, 'custom_view_file') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
