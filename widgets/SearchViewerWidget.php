<?php
namespace wardany\dform\widgets;

use yii\base\Widget;
use yii\widgets\ActiveForm;

/**
 * @author muhammad wardany
 */
class SearchViewerWidget extends Widget
{
    /**
     * @var \yii\db\ActiveRecord
     */
    public $model ;

    /**
     * @var \yii\widgets\ActiveForm the form that this field is associated with.
     */
    public $form;
    
    public function init() {
        $this->form->fieldClass = \wardany\dform\helpers\DynamicActiveSearchField::className();
        parent::init();
    }
    
    public function run()
    {
        
        $inputs = $this->model->getExtraAttributes();
        $inputs_fields =[];
        foreach ($inputs as $input => $model) {
            $inputs_fields[]= $this->form->field($this->model, $input)->dynamicField($model);
        }
        return implode("\n", $inputs_fields);
    }
}
?>
