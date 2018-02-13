<?php

namespace wardany\dform\validators_helpers;

use Yii;
/**
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class NumberValidatorHelper extends BaseValidatorHelper{
    const ID = 'number';
    public  $required = false;
    
    public $enabled;
    public $integerOnly = false;
    public $min;
    public $max;
    
    public function rules() {
        return[
            [
                'enabled', 
                'required', 
                'requiredValue'=> 1, 
                'message'=> Yii::t('yii', '{attribute} must be selected for this input type.'),
                'when'=> function($model){return $model->required;},
                'whenClient'=> "function (attribute, value) {
                    return ".$this->required.";
                }"
            ],
            [['enabled', 'integerOnly'], 'boolean'],
            [['min', 'max'], 'integer'],
        ];
    }
    
    public function attributeLabels() {
        return[
            'enabled'=> 'Number'
        ];
    }

    public function getProperties() {
        return ['max', 'min', 'integerOnly'];
    }
}
