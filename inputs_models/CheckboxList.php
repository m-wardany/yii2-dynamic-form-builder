<?php

namespace wardany\dform\inputs_models;

use wardany\dform\helpers\InputHelper;
use wardany\dform\helpers\ValidationRuleHelper;

/**
 *
 * @author muhammad wardany <muhammad.wardany@gmail.com>
 */
class CheckboxList extends \wardany\dform\models\DynamicFormInput {
    public function __construct($config = array()) {
        $this->type = InputHelper::CHECKBOX_LIST;
        parent::__construct($config);
    }
    
    public function getValidatorsModels() {
        $vh = new ValidationRuleHelper($this);
        return $vh
                ->range(true)
                ->reqired()                
                ->build();
    }  
}
