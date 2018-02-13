<?php

namespace wardany\dform\validators_helpers;

use Yii;
/**
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class StringValidatorHelper extends BaseValidatorHelper{
    const ID = 'string';
    public  $required = false;
    
    public $enabled;
    public $min;
    public $max;
    public $length;
    
    public function rules() {
        return[
            [
                'enabled', 
                'required', 
                'requiredValue'=> 1, 
                'message'=> Yii::t('yii', '{attribute} must be selected for this input type.'),
                'when'=> function($model){return $model->required === true;},
                'whenClient'=> "function (attribute, value) {
                    return ".$this->required.";
                }"
                
            ],
            ['enabled', 'boolean'],
            [['min', 'max', 'length'], 'integer'],
        ];
    }
    
    public function attributeLabels() {
        return[
            'enabled'=> 'String'
        ];
    }

    public function getProperties() {
        return ['max', 'min', 'length'];
    }
}
