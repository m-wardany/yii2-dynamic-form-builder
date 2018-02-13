<?php
namespace wardany\dform\helpers;

use yii\helpers\Html;

/**
 * Description of ActiveDynamicField
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class DynamicActiveField extends \yii\widgets\ActiveField{
    /**
     *
     * @var \wardany\dform\models\DynamicFormInput
     */
    protected $input_model ;

    protected $hide_label;
    protected $break_after_container;
    
    public function dynamicField($model) {
        $this->input_model = $model;
        $input_type = InputHelper::input($model->type)['input'];
        $this->setExtraOptions($this->input_model->getHtmlOptions());
        return $this->{$input_type}();
    }
    
    protected function setExtraOptions($options) {
        $this->hide_label = $options['hide_label'];
        $this->break_after_container = $options['break_after_container'];
        foreach ($options['options'] as $property => $value) {
            $this->{$property} =$value;
        }
    }

    public function label($label = null, $options = array()) {
        parent::label($this->input_model->label, $options);
    }
    
    public function numberInput($options = array()) {
        $options['type']= 'number';
        return parent::textInput($options);
    }
    
    public function dynamicDropDownList(){
        return parent::dropDownList( $this->input_model->getRelatedList(), ['prompt'=> $this->inputOptions['placeHolder']]);
    }

    public function dynamicRadioList(){
        return parent::radioList( $this->input_model->getRelatedList());
    }

    public function dynamicCheckboxlist(){
        return parent::checkboxList($this->input_model->getRelatedList());
    }

    public function hint($content, $options = array()) {
        return parent::hint($this->input_model->hint, $options);
    }
    
    /**
     * Renders the closing tag of the field container.
     * @return string the rendering result.
     */
    public function end()
    {
        $break_tag = $this->break_after_container? Html::tag('div', null, ['style'=> 'visibility: hidden;  display: block;  font-size: 0;  content: " "; clear: both;height: 0;']): null;
        return parent::end().$break_tag;
    }
}
