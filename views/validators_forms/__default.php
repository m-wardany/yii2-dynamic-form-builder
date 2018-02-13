<?php
/* @var $this yii\web\View */
/* @var $model \wardany\dform\models\ValidationRule */
/* @var $form yii\widgets\ActiveForm */
$view_exists = file_exists(__DIR__.'/'.$view.'.php');
?>

<div class="panel-heading validator-enabled">
    <?= $form->field($model, 'enabled')->checkbox(['data-toggle'=>"toggle", 'data-style'=> 'ios', 'data-size'=> 'small']) ?>
</div>        
        
<?php if($view_exists): ?>
    <div class="panel-collapse collapse <?= $model->enabled? 'in':null ?>">
        <div class="panel-body">
            <?= $this->render($view, ['model'=> $model, 'form'=> $form]); ?>
        </div>
    </div>
<?php endif; ?>