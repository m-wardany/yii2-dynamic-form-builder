<?php

namespace wardany\dform\inputs_models;

use wardany\dform\helpers\InputHelper;
use wardany\dform\helpers\ValidationRuleHelper;
use yii\validators\CompareValidator;

/**
 *
 * @author muhammad wardany <muhammad.wardany@gmail.com>
 */
class NumberInput extends \wardany\dform\models\DynamicFormInput implements \wardany\dform\models\IInput{
    public function __construct($config = array()) {
        $this->type = InputHelper::NUMBER;
        parent::__construct($config);
    }
    
    public function getValidatorsModels() {
        $vh = new ValidationRuleHelper($this);
        return $vh
                ->number(true)
                ->string()
                ->reqired()
                ->compare(CompareValidator::TYPE_NUMBER)
                ->build();
    }  
}
