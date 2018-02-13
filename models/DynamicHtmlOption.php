<?php
namespace wardany\dform\models;

use yii\base\UnknownPropertyException;
use yii\helpers\Inflector;

/**
 *
 * @author Muhamamd Wardany <muhammad.wardany@gmail.com>
 */
trait DynamicHtmlOption{
    public $break_after_container      = false;
    public $template                    = "{label}\n{input}\n{hint}\n{error}";
    public $remove_container            = false;
    public $options_class               = 'form-group';
    public $inputOptions_class          = 'form-control';
    public $inputOptions_placeHolder    = null;
    public $errorOptions_class          = 'help-block';
    public $hide_label                  = false;
    public $labelOptions_class          = 'control-label';
    public $hintOptions_class           = 'hint-block';

    public function htmlElementsRules() {
        return[
            [['template', 'options_class', 'inputOptions_class', 'inputOptions_placeHolder', 'errorOptions_class', 'labelOptions_class', 'hintOptions_class'], 'string', 'max'=> 255],
            [['remove_container', 'hide_label', 'break_after_container'], 'boolean']
        ];
    }
    
    public function setHtmlOptions() {
        $options = empty($this->html_attributes_options)? []: json_decode($this->html_attributes_options, true);
        $options = array_merge($this->getHtmlOptions(), $options);
        $this->remove_container = $options['remove_container'];
        $this->break_after_container = $options['break_after_container'];
        $this->template = $options['options']['template'];
        $this->hintOptions_class = $options['options']['hintOptions']['class'];
        $this->errorOptions_class = $options['options']['errorOptions']['class'];
        $this->labelOptions_class = $options['options']['labelOptions']['class'];
        $this->inputOptions_class = $options['options']['inputOptions']['class'];
        $this->inputOptions_placeHolder = $options['options']['inputOptions']['placeHolder'];
        $this->options_class = $options['options']['options']['class'];
    }
    
    public function getHtmlOptions() {
        return [
            'hide_label'=> $this->hide_label,
            'remove_container'=> $this->remove_container,
            'break_after_container'=> $this->break_after_container,
            'options'=>[
                'template'=> $this->template,
                'options'=> $this->getContainerOptions(),
                'inputOptions'=> $this->getInputOptions(),
                'hintOptions'=> ['class'=> $this->labelOptions_class],
                'errorOptions'=> ['class'=> $this->errorOptions_class],
                'labelOptions'=> ['class'=> $this->labelOptions_class],
            ]
        ];  
    }
    
    protected function getContainerOptions() {
        if($this->remove_container)
            return ['tag'=> false];
        else
            return ['class'=> $this->options_class];
    }
    
    protected function getInputOptions() {
        return  ['class'=> $this->inputOptions_class, 'placeHolder'=> $this->inputOptions_placeHolder];
    }    
}
