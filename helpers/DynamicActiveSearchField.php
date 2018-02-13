<?php
namespace wardany\dform\helpers;

use yii\helpers\Html;
use andrew72ru\ionrange\Slider;
/**
 * Description of ActiveDynamicField
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class DynamicActiveSearchField extends DynamicActiveField{
     
    public function dynamicField($model) {
        $this->input_model = $model;
        $input_type = $model->search_widget? InputHelper::searchWidget($model->search_widget)['input']: InputHelper::input($model->type)['input'];
        $this->setExtraOptions($this->input_model->getSearchOptions());
        return $this->{$input_type}();
    }
  
    public function rangeInput() {
        $values = $this->model->getRangeInputValues($this->input_model, $this->attribute);
        return $this->widget(\andrew72ru\ionrange\Slider::className(), [
            'options' => $this->options, // Html tag options
            'clientOptions' => [
                'type'  => 'double',            // Slider type
                'grid'  => true,                // Whether is grid of values enabled or not
                'min'   => $values['min'],      // min slider value
                'max'   => $values['max'],      // max slider value
                'from'  => $values['from'],     // start position for left handle
                'to'    => $values['to'],       // start position for right handle
            ],
        ]);
    }
}
