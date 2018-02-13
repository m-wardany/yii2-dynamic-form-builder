<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model wardany\dform\models\DynamicFormInput */

$input_properties = \wardany\dform\helpers\InputHelper::input($model->type);
$this->title = 'Add new '.$input_properties['title'];
$this->params['breadcrumbs'][] = ['label' => 'Dynamic Form Inputs', 'url' => ['index', 'id'=> Yii::$app->request->get('form_id')]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dynamic-form-input-create">

    <h1><i class="<?= $input_properties['icon'] ?>"></i> <?= Html::encode($input_properties['title']) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'validators'=> $validators,
        'list'=> $list
    ]) ?>

</div>
