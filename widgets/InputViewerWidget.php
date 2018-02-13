<?php
namespace wardany\dform\widgets;

use yii\base\Widget;

/**
 * @author muhammad wardany
 */

class InputViewerWidget extends Widget
{
    /**
     * @var \yii\db\ActiveRecord
     */
    public $model ;

    /**
     * @var ActiveForm the form that this field is associated with.
     */
    public $form;
    
    public function init() {
        $this->form->fieldClass = \wardany\dform\helpers\DynamicActiveField::className();
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
