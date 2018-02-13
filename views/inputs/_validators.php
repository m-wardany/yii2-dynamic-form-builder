<?php
/* @var $this yii\web\View */
/* @var $model \wardany\dform\models\ValidationRule */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="panel-group">
    <?php foreach ($models as $view=> $model): ?>
        <div class="panel panel-default">
            <?= $this->render("/validators_forms/__default", ['view'=> $view, 'model'=> $model, 'form'=> $form]); ?>
        </div>
    <?php endforeach;  ?>
</div>