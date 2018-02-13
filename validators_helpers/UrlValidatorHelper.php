<?php

namespace wardany\dform\validators_helpers;

use Yii;
/**
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class UrlValidatorHelper extends BaseValidatorHelper{
    const ID = 'url';
    
    public $enabled;
    
    public function rules() {
        return[
            ['enabled', 'boolean'],
        ];
    }
    
    
    public function attributeLabels() {
        return[
            'enabled'=> 'Url'
        ];
    }

    public function getProperties() {
        return true;
    }

}
