<?php

use wardany\dform\helpers\InputHelper;


/* @var $this yii\web\View */
/* @var $model wardany\dform\models\DynamicFormInputSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'enable_search')->checkbox() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'search_widget')->dropDownList(InputHelper::input($model->type)['available_search_widget'], ['prompt'=> '']) ?>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'search_break_after_container')->checkbox() ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'search_hide_label')->checkbox() ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'search_remove_container')->checkbox() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'search_template') ?>
        <?= $form->field($model, 'search_options_class') ?>
        <?= $form->field($model, 'search_inputOptions_class') ?>
        <?= $form->field($model, 'search_inputOptions_placeHolder') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'search_errorOptions_class') ?>
        <?= $form->field($model, 'search_labelOptions_class') ?>
        <?= $form->field($model, 'search_hintOptions_class') ?>
    </div>
</div>


