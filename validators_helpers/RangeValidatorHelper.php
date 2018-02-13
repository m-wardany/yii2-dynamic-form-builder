<?php

namespace wardany\dform\validators_helpers;

use Yii;
/**
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class RangeValidatorHelper extends BaseValidatorHelper{
    const ID = 'wardany\dform\validators\ListRangeValidator';
    
    public $enabled;
    public $allowArray;
    
    public function rules() {
        
        return[
            [['enabled', 'allowArray'], 'boolean'],
        ];
    }
    
    
    public function attributeLabels() {
        return[
            'enabled'=> 'Range'
        ];
    }

    public function getProperties() {
        return ['allowArray'];
    }

}
