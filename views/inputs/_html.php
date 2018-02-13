<?php

/* @var $this yii\web\View */
/* @var $model \wardany\dform\models\DynamicFormInput */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'break_after_container')->checkbox() ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'hide_label')->checkbox() ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'remove_container')->checkbox() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'template') ?>
        <?= $form->field($model, 'options_class') ?>
        <?= $form->field($model, 'inputOptions_class') ?>
        <?= $form->field($model, 'inputOptions_placeHolder') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'errorOptions_class') ?>
        <?= $form->field($model, 'labelOptions_class') ?>
        <?= $form->field($model, 'hintOptions_class') ?>
    </div>
</div>










