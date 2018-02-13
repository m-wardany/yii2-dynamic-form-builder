<?php

use wardany\dform\validators_helpers\CompareValidatorHelper;
/* @var $this yii\web\View */
/* @var $model \wardany\dform\models\ValidationRule */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-4">
        <?= $form->field($model, 'compareAttribute') ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'compareValue') ?>
    </div>
    <div class="col-sm-4">
        <?= $form->field($model, 'operator')->dropDownList(array_combine(CompareValidatorHelper::COMPARE_OPERATORS, CompareValidatorHelper::COMPARE_OPERATORS)) ?>
    </div>
</div>