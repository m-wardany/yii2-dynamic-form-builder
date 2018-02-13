<?php

namespace wardany\dform\helpers;

/**
 *
 * @author muhammad wardany <muhammad.wardany@gmail.com>
 */

use Yii;
use wardany\dform\inputs_models;

class InputHelper extends \yii\base\Component{

    const TEXT_INPUT = 1;
    const TEXT_AREA = 2;
    const NUMBER = 3;
    const CHECKBOX = 4;
    const CHECKBOX_LIST = 5;
    const DROPDOWN_LIST = 6;
    const RADIO_LIST = 7;
    const FILE = 8;
    const IMAGE = 9;
    const DATE_TIME = 10;
    const RANGE_INPUT = 11;

    public static function getInstance($type) {
        $input= self::input($type);
        $input_class = $input['class'];
        return new $input_class();
    }

    public static function inputs() {
        return[
            self::TEXT_INPUT=>[
                'title'=> 'Text input',
                'class'=> inputs_models\TextInput::className(),
                'icon'=>'glyphicon glyphicon-text-width',
                'input'=> 'textInput',
                'available_search_widget'=> [self::TEXT_INPUT],
                'searchable'=> true,
            ],
            self::TEXT_AREA=>[
                'title'=> 'Textarea',
                'class'=> inputs_models\TextArea::className(),
                'icon'=>'glyphicon glyphicon-edit',
                'input'=> 'textarea',
                'available_search_widget'=> [self::TEXT_INPUT=> 'Text input'],
                'searchable'=> true,
            ],
            self::NUMBER=>[
                'title'=> 'Number input',
                'class'=> inputs_models\NumberInput::className(),
                'icon'=>'glyphicon glyphicon-shopping-cart',
                'input'=> 'numberInput',
                'available_search_widget'=> [self::TEXT_INPUT=> 'Text input', self::RANGE_INPUT=> 'Range input'],
                'searchable'=> true,
            ],
            self::CHECKBOX_LIST=>[
                'title'=> 'Checkbox List',
                'class'=> inputs_models\CheckboxList::className(),
                'icon'=> 'glyphicon glyphicon-text-width',
                'input'=> 'dynamicCheckboxlist',
                'available_search_widget'=> [self::DROPDOWN_LIST=>'Dropdown list', self::RADIO_LIST=> 'Radio list', self::CHECKBOX_LIST=> 'checkBox List'],
                'searchable'=> true,
            ],
            self::DROPDOWN_LIST=>[
                'title'=> 'Dropdown List',
                'class'=> inputs_models\DropdownList::className(),
                'icon'=>'glyphicon glyphicon-collapse-down',
                'input'=> 'dynamicDropdownList',
                'available_search_widget'=> [self::DROPDOWN_LIST=>'Dropdown list', self::RADIO_LIST=> 'Radio list', self::CHECKBOX_LIST=> 'checkBox List'],
                'searchable'=> true,
            ],
            self::RADIO_LIST=>[
                'title'=> 'Radiobutton list',
                'class'=> inputs_models\RadioList::className(),
                'icon'=>'glyphicon glyphicon-record',
                'input'=> 'dynamicRadioList',
                'available_search_widget'=> [self::DROPDOWN_LIST=>'Dropdown list', self::RADIO_LIST=> 'Radio list', self::CHECKBOX_LIST=> 'checkBox List'],
                'searchable'=> true,
            ],
//            
//            'file'=>[
//                'title'=> 'File input'),
//                'class'=> inputs\FieldFile::className(),
//                'icon'=>'glyphicon glyphicon-folder-open',
//                'form'=> '__file',
//            ],
//            'image'=>[
//                'title'=> 'Image input'),
//                'class'=> inputs\FieldImage::className(),
//                'icon'=>'glyphicon glyphicon-picture',
//                'form'=> '__image',
//            ],
        ];
    }
    
    public static function searchWidgets() {
        return[
            self::RANGE_INPUT=>[
                'title'=> 'Range Input',
                'input'=> 'rangeInput',
            ],
            self::TEXT_INPUT=>[
                'title'=> 'Text input',
                'input'=> 'textInput',
            ],
            self::NUMBER=>[
                'title'=> 'Number input',
                'input'=> 'numberInput',
            ],
            self::CHECKBOX_LIST=>[
                'title'=> 'Checkbox List',
                'input'=> 'dynamicCheckboxlist',
            ],
            self::DROPDOWN_LIST=>[
                'title'=> 'Dropdown List',
                'input'=> 'dynamicDropdownList',
            ],
            self::RADIO_LIST=>[
                'title'=> 'Radiobutton list',
                'input'=> 'dynamicRadioList',
            ],
        ];
    }
    
    public static function input($id) {
        $inputs = self::inputs();
        if(array_key_exists($id, $inputs))
            return $inputs[$id];
    }
    
    public static function searchWidget($id) {
        $inputs = self::searchWidgets();
        if(array_key_exists($id, $inputs))
            return $inputs[$id];
    }
}
