<?php

namespace wardany\dform\validators_helpers;

/**
 *
 * @author Muhammad wardany <muhammad.wardany@gmail.com>
 */
abstract class BaseValidatorHelper extends \yii\base\Model{
    
    /**
     * 
     * @param array $old_rules
     * @param array $config
     */
    public function __construct($old_rules, $config = array()) {
        parent::__construct($config);
        if(array_key_exists(static::ID, $old_rules)){
            $this->setOldRules($old_rules);
        }
    }
    
    protected function setOldRules($rules) {
        if(array_key_exists(static::ID, $rules)){
            $this->enabled = true;
            $options = $rules[static::ID];
            if(is_array($options)){
                foreach ($options as $attribute => $value) {
                    $this->{$attribute} = $value;
                }
            }
        }            
    }
    
    public function getRule() {
        if(!$this->enabled)
            return null;
        $properties = $this->getProperties();
        if(!is_array($properties))
            return $properties;
        $rule= [];
        foreach ($properties as $property) {
            $value = $this->$property;
            if(!empty($value)){
                $rule[$property]= $value;
            }
        }
        return count($rule)? $rule: $this->enabled;
    }
    
    public abstract function getProperties();
}
