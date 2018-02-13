<?php

namespace wardany\dform\validators_helpers;

use Yii;
/**
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class EmailValidatorHelper extends BaseValidatorHelper{
    const ID = 'email';
    
    public $enabled;
    
    public function rules() {
        return[
            ['enabled', 'boolean'],
        ];
    }
    
    
    public function attributeLabels() {
        return[
            'enabled'=> 'Email'
        ];
    }

    public function getProperties() {
        return true;
    }

}
