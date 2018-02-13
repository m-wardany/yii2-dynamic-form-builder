<?php

use wardany\dform\models\DynamicForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model DynamicForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dynamic-form-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'custom_form_file')->dropDownList($model->getCustomFormFiles(), ['prompt'=> 'Selecte custom form file.']) ?>

    <?= $form->field($model, 'custom_view_file')->dropDownList($model->getCustomViewFiles(), ['prompt'=> 'Selecte custom view file.']) ?>

    <?= $form->field($model, 'custom_search_file')->dropDownList($model->getCustomSearchFiles(), ['prompt'=> 'Selecte custom search file.']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
