<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel wardany\dform\models\DynamicFormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dynamic Forms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dynamic-form-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Add new Form', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'note:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
