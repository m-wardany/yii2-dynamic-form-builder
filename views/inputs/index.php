<?php

use richardfan\sortable\SortableGridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel wardany\dform\models\DynamicFormInputSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dynamic Form Inputs';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="dynamic-form-input-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-sm-2">
            <?php foreach ($inputs as $input_id => $options) {
                echo Html::a(
                        '<span class="'.$options['icon'].'"></span> '.$options['title'],
                        Url::to(['create', 'type'=> $input_id, 'form_id'=> $form_id]),
                        [
                           'class'=> 'btn btn-default btn-block btn-social get-field',                           
                           'title'=>  $options['title']
                        ]);
            } ?>
        </div>    
        <div class="col-sm-10">
            <?= SortableGridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'sortUrl' => Url::to(['sortItem']),
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=> 'inputIcon',
                        'format'=> 'html',
                        'label'=> false
                    ],
                    [
                        'attribute'=> 'type',
                        'value'=> 'inputType',
                        'filter'=> $inputs_list
                    ],
                    'name',
                    'label',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
