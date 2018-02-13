<?php

namespace wardany\dform\validators_helpers;

use Yii;
/**
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class RequiredValidatorHelper extends BaseValidatorHelper{
    const ID = 'required';
    
    public $enabled;
    
    public function rules() {
        return[
            ['enabled', 'boolean'],
        ];
    }
    
    
    public function attributeLabels() {
        return[
            'enabled'=> 'Required'
        ];
    }

    public function getProperties() {
        return true;
    }

}
