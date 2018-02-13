<?php

namespace wardany\dform\validators_helpers;

use Yii;
use yii\validators\CompareValidator;
/**
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class CompareValidatorHelper extends BaseValidatorHelper{
    
    const COMPARE_OPERATORS = ['===', '==', '!==', '!=', '>', '>=', '<', '<='];
    
    const ID = 'compare';
    
    public $enabled;
    public $compareAttribute;
    public $compareValue;
    public $type = CompareValidator::TYPE_STRING;
    public $operator = '==';
    
    public function rules() {
        return[
            ['enabled', 'boolean'],
            [['compareAttribute', 'compareValue', 'operator'], 'string', 'max'=> 255],
            ['operator', 'in', 'range'=> self::COMPARE_OPERATORS],
            ['type', 'in', 'range'=> [CompareValidator::TYPE_NUMBER, CompareValidator::TYPE_STRING]],
            ['type', 'default', 'value'=> CompareValidator::TYPE_STRING],
        ];
    }
    
    public function attributeLabels() {
        return[
            'enabled'=> 'Compare'
        ];
    }

    public function getProperties() {
        return ['compareAttribute', 'compareValue', 'operator', 'type'];
    }

}
