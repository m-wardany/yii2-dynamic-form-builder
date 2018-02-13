<?php
/* @var $this yii\web\View */
/* @var $model \wardany\dform\models\ValidationRule */
/* @var $form yii\widgets\ActiveForm */
?>
<?= $form->field($model, 'integerOnly')->checkbox() ?>
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'max') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'min') ?>
    </div>
</div>