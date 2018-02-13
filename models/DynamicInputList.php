<?php

namespace wardany\dform\models;

use wardany\dform\helpers\ActionHelper;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * This is the model class for table "dynamic_inputs_lists".
 *
 * @property int $id
 * @property int $input_id
 * @property int $list_type
 * @property string $data_items
 * @property string $data_action
 *
 * @property DynamicFormInput $input
 */
class DynamicInputList extends \yii\db\ActiveRecord
{
    const TYPE_ITEMS = 1;
    const TYPE_ACTION = 2;
    
    public $_data_items;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dynamic_inputs_lists';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $input_type_id = Html::getInputId($this, 'list_type');
        return [
            ['list_type', 'required'],
            ['list_type', 'in', 'range'=> array_keys($this->listTypes())],
            [['input_id', 'list_type'], 'integer'],
            [['_data_items'], 'string'],
            [['data_action'], 'string', 'max' => 255],
            [['input_id'], 'exist', 'skipOnError' => true, 'targetClass' => DynamicFormInput::className(), 'targetAttribute' => ['input_id' => 'id']],
            ['data_action', 'in', 'range'=> array_keys(ActionHelper::getAllFilesAsArray())],
            ['data_action', 'required', 
                'when'=> function($model){return $model->list_type === self::TYPE_ACTION;},
                'whenClient'=> "function (attribute, value) {
                    return $('#".$input_type_id."').find(':checked').val()== '".self::TYPE_ACTION."';
                }"
            ],
            ['_data_items', 'required', 
                'when'=> function($model){return $model->list_type === self::TYPE_ITEMS;},
                'whenClient'=> "function (attribute, value) {
                    return $('#".$input_type_id."').find(':checked').val()== '".self::TYPE_ITEMS."';
                }"
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'input_id' => 'Input ID',
            'list_type' => 'List Type',
            'data_items' => 'Data Items',
            '_data_items' => 'Data Items',
            'data_action' => 'Data Action',
        ];
    }

    public function listTypes() {
        return[
            self::TYPE_ITEMS=> 'Items',
            self::TYPE_ACTION=> 'Actions',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInput()
    {
        return $this->hasOne(DynamicFormInput::className(), ['id' => 'input_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasMany(DynamicForm::className(), ['id' => 'form_id'])
            ->viaTable('dynamic_form_inputs', ['id'=> 'input_id']);
    }
    
    public function getItems() {
        if($this->list_type == self::TYPE_ITEMS)
            return json_decode ($this->data_items);
        else{
            
        }
    }
    
    public function afterFind() {
        if($this->list_type == self::TYPE_ITEMS)
            $this->_data_items = implode (',', Json::decode($this->data_items));
        parent::afterFind();
    }
    
    public function beforeSave($insert) {
        if($this->list_type == self::TYPE_ITEMS){
            $this->data_items = Json::encode(explode (',', $this->_data_items));
            $this->data_action = null;
        }
        else
            $this->data_items = null;
        
        return parent::beforeSave($insert);
    }
}
