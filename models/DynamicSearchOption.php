<?php
namespace wardany\dform\models;

use yii\base\UnknownPropertyException;
use yii\helpers\Inflector;

/**
 *
 * @author Muhamamd Wardany <muhammad.wardany@gmail.com>
 */
trait DynamicSearchOption{
    public $search_break_after_container      = false;
    public $search_template                    = "{label}\n{input}\n{hint}\n{error}";
    public $search_remove_container            = false;
    public $search_options_class               = 'form-group';
    public $search_inputOptions_class          = 'form-control';
    public $search_inputOptions_placeHolder    = null;
    public $search_errorOptions_class          = 'help-block';
    public $search_hide_label                  = false;
    public $search_labelOptions_class          = 'control-label';
    public $search_hintOptions_class           = 'hint-block';

    public function searchElementsRules() {
        return[
            ['search_widget', 'in', 'range'=> array_keys(\wardany\dform\helpers\InputHelper::searchWidgets())],
            ['search_options', 'string'],
            ['search_widget', 'default', 'value'=> function($model){ return $model->type;}],
            [['search_template', 'search_options_class', 'search_inputOptions_class', 'search_inputOptions_placeHolder', 'search_errorOptions_class', 'search_labelOptions_class', 'search_hintOptions_class'], 'string', 'max'=> 255],
            [['enable_search', 'search_remove_container', 'search_hide_label', 'search_break_after_container'], 'boolean']
        ];
    }
    
    public function setSearchOptions() {
        $stored_options = empty($this->search_options)? []: json_decode($this->search_options, true);
        $options = array_merge($this->getSearchOptions(), $stored_options);
        $this->search_remove_container = $options['remove_container'];
        $this->search_break_after_container = $options['break_after_container'];
        $this->search_template = $options['options']['template'];
        $this->search_hintOptions_class = $options['options']['hintOptions']['class'];
        $this->search_errorOptions_class = $options['options']['errorOptions']['class'];
        $this->search_labelOptions_class = $options['options']['labelOptions']['class'];
        $this->search_inputOptions_class = $options['options']['inputOptions']['class'];
        $this->search_inputOptions_placeHolder = $options['options']['inputOptions']['placeHolder'];
        $this->search_options_class = $options['options']['options']['class'];
    }
    
    public function getSearchOptions() {
        return [
            'hide_label'=> $this->search_hide_label,
            'remove_container'=> $this->search_remove_container,
            'break_after_container'=> $this->search_break_after_container,
            'options'=>[
                'template'=> $this->search_template,
                'options'=> $this->getSearchContainerOptions(),
                'inputOptions'=> $this->getSearchInputOptions(),
                'hintOptions'=> ['class'=> $this->search_labelOptions_class],
                'errorOptions'=> ['class'=> $this->search_errorOptions_class],
                'labelOptions'=> ['class'=> $this->search_labelOptions_class],
            ]
        ];  
    }
    
    protected function getSearchContainerOptions() {
        if($this->search_remove_container)
            return ['tag'=> false];
        else
            return ['class'=> $this->search_options_class];
    }
    
    protected function getSearchInputOptions() {
        return  ['class'=> $this->search_inputOptions_class, 'placeHolder'=> $this->search_inputOptions_placeHolder];
    }    
}
