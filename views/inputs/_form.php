<?php

use wardany\dform\assets\DynamicFormBuilderAsset;
use wardany\dform\assets\TagInputAsset;
use wardany\dform\helpers\InputHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model wardany\dform\models\DynamicFormInput */
/* @var $form yii\widgets\ActiveForm */

DynamicFormBuilderAsset::register($this);
TagInputAsset::register($this);
?>
<?php $form = ActiveForm::begin(['options'=> ['id'=> 'dynamic-input-form']]); ?>
<div class="panel with-nav-tabs panel-default">
    <div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1default" data-toggle="tab">Basics</a></li>
            <li><a href="#tab2default" data-toggle="tab">Validations</a></li>
            <li><a href="#tab3default" data-toggle="tab">Html Options</a></li>
            <?php if(InputHelper::input($model->type)['searchable']): ?>
                <li><a href="#tab4default" data-toggle="tab">Search Options</a></li>
            <?php endif; ?>
<!--            <li><a href="#tab5default" data-toggle="tab">View Options</a></li>-->
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1default">
                <?= $this->render('_basics', ['model'=> $model, 'form'=> $form, 'list'=> $list]) ?>
            </div>
            <div class="tab-pane fade" id="tab2default">
                <?= $this->render('_validators', ['models'=> $validators, 'form'=> $form]) ?>
            </div>
            <div class="tab-pane fade" id="tab3default">
                <?= $this->render('_html', ['model'=> $model, 'form'=> $form]) ?>
            </div>
            <?php if(InputHelper::input($model->type)['searchable']): ?>
                <div class="tab-pane fade" id="tab4default">
                    <?= $this->render('_search', ['model'=> $model, 'form'=> $form]) ?>
                </div>
            <?php endif; ?>                
<!--            <div class="tab-pane fade" id="tab5default">Default 4</div>-->
        </div>
    </div>
    <div class="panel-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

