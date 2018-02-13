<?php

namespace wardany\dform\inputs_models;

use wardany\dform\helpers\InputHelper;
use wardany\dform\helpers\ValidationRuleHelper;

/**
 *
 * @author muhammad wardany <muhammad.wardany@gmail.com>
 */
class TextInput extends \wardany\dform\models\DynamicFormInput implements \wardany\dform\models\IInput{
    public function __construct($config = array()) {
        $this->type = InputHelper::TEXT_INPUT;
        parent::__construct($config);
    }
    
    public function getValidatorsModels() {
        $vh = new ValidationRuleHelper($this);
        return $vh
                ->string(true)
                ->reqired()
                ->compare()
                ->url()
                ->email()
                ->build();
    }  
}
