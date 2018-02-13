<?php
/* @var $this yii\web\View */
/* @var $model \wardany\dform\models\DynamicInputList */
/* @var $form yii\widgets\ActiveForm */
?>
<?= $form->field($model, 'list_type')->radioList($model->listTypes()) ?>
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, '_data_items')->textarea(['id'=> 'tag-input']); ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'data_action')->dropdownList(\wardany\dform\helpers\ActionHelper::getAllFilesAsArray(), ['prompt'=> 'Select action']) ?>
    </div>
</div>