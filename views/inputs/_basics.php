<?php
/* @var $this yii\web\View */
/* @var $model \wardany\dform\models\ValidationRule */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <?= $form->field($model, 'enable_view')->checkbox() ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($model, 'hint') ?>
    </div>
</div>
<?php if($model->isListable()): ?>
    <hr/>
    <?= $this->render('_list', ['model'=> $list, 'form'=> $form]) ?>
<?php endif; ?>