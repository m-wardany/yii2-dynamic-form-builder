<?php
namespace wardany\dform\behaviors;

use wardany\dform\models\DynamicFormInput;
use yii\base\UnknownPropertyException;
use yii\db\BaseActiveRecord;

/**
 * Description of DynamicFormBuilderBehavior
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class DynamicFormBuilderBehavior extends \yii\base\Behavior{
    
    public $form_relation = 'form';
    public $values_relation = 'details';
    
    protected $extra_attributes= [];
    protected $extra_list_data =[];
       
    public function events() {
        return[
            BaseActiveRecord::EVENT_INIT            => 'start',
            BaseActiveRecord::EVENT_AFTER_FIND      => 'afterFind',
            BaseActiveRecord::EVENT_AFTER_INSERT    => 'afterSave',
            BaseActiveRecord::EVENT_AFTER_UPDATE    => 'afterSave',
        ];
    }
    
    public function start() {
        $this->attachAllAttributes();
        $this->attachValidators();
    }   
    
    public function afterFind() {
        $this->attachExtraAttributes();
    }   
    
    public function attachAllAttributes($searchable_only = false) {
         $query = DynamicFormInput::find()
                ->alias('inputs')
                ->orderBy('sortOrder')
                ->indexBy('name');
        if($searchable_only)
            $query->andWhere (['inputs.enable_search'=> true]);
        if($this->owner->form)
            $query->where(['inputs.form_id'=> $this->owner->{$this->form_relation}->id]);
        $this->extra_attributes= $query->all();
    }
    
    public function attachExtraAttributes() {
        $query = DynamicFormInput::find()
                ->alias('inputs')
                ->leftJoin(['values'=>'post_details'], 'inputs.id = values.input_id')
                ->select(['inputs.name','value'=>'values.value']);
        if($this->owner->form)
            $query->where(['inputs.form_id'=> $this->owner->{$this->form_relation}->id, 'values.post_id'=> $this->owner->id]);
        $this->mergeAttributes($query->all());
    }
    
    private function mergeAttributes($attributes) {
        foreach ($attributes as $model) {
            $input = $this->extra_attributes[$model->name];
            $input->value = $model->value;
        }   
    }
    
    public function attachValidators() {
        $all_rules = $this->owner->form->drawValidationRules($this->owner);
    }
    
    public function afterSave() {
        $this->owner->unLinkAll($this->values_relation, true);
        foreach ($this->extra_attributes as $attribute_name => $input) {
            $this->owner->link($this->values_relation, $input, ['value'=> $input->value]);
        }
    }    
    
    public function getExtraAttributes() {
        return $this->extra_attributes;
    }
    
    public function getExtraAttributesValues() {
        return \yii\helpers\ArrayHelper::getColumn($this->extra_attributes, 'value');
    }
    
    public function getExtraAttributeValue($name) {
        $input = $this->extra_attributes[$name];
        return $input->getFinalValue();
    }
    
    public function getFormatedValue($name) {
        $input = $this->extra_attributes[$name];
        return $input->getFormatedValue();
    }

    public function getRelatedList($name) {
        if(array_key_exists($name, $this->extra_attributes))
            return $this->extra_attributes[$name]->getRelatedList();        
        return [];
    }
    public function canGetProperty($name, $checkVars = true) {
        return parent::canGetProperty($name, $checkVars) || array_key_exists($name, $this->extra_attributes);
    }
    
    public function __get($name) {
        try {
            parent::__get($name);            
        } catch (UnknownPropertyException $exc) {
            if(array_key_exists($name, $this->extra_attributes))
                return $this->getExtraAttributeValue($name);
            throw $exc;
        }
    }
         
    public function canSetProperty($name, $checkVars = true) {
        return parent::canSetProperty($name, $checkVars) || array_key_exists($name, $this->extra_attributes);
    }
    
    public function __set($name, $value) {
        try {
            parent::__set($name, $value);            
        } catch (UnknownPropertyException $exc) {
            if(array_key_exists($name, $this->extra_attributes))
                $this->extra_attributes[$name]->setFinalValue($value);
            else
                throw $exc;
        }
    }    
}
