<?php
/* @var $this yii\web\View */
/* @var $model \wardany\dform\models\ValidationRule */
/* @var $form yii\widgets\ActiveForm */
?> 
<div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'max') ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'min') ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'length') ?>
    </div>
</div>