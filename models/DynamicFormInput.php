<?php

namespace wardany\dform\models;

use wardany\dform\helpers\InputHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\validators\Validator;

/**
 * This is the model class for table "dynamic_form_inputs".
 *
 * @property int $id
 * @property int $form_id
 * @property int $type
 * @property string $name
 * @property string $label
 * @property string $hint
 * @property string $html_attributes_options
 * @property string $validation_rules
 * @property int $enable_search 
 * @property string $search_options 
 * @property int $enable_view 
 * @property string $view_options 
 * @property string $parent_node_id 
 * @property int $sortOrder
 * @property int $search_widget
 *
 * @property DynamicForm $form
 * @property DynamicInputList[] $list 
 */
class DynamicFormInput extends \yii\db\ActiveRecord
{
    use DynamicHtmlOption;
    use DynamicSearchOption;
    
    public $validators_models;
    public $value ;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dynamic_form_inputs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $html_rules = $this->htmlElementsRules();
        $search_rules = $this->searchElementsRules();
        $rules = [
            [['form_id', 'type', 'name', 'label'], 'required'],
            ['name', 'unique', 'targetAttribute'=> ['name', 'form_id']],
//            ['name', 'match', 'pattern' => '/(^|.*\])([\w\.\+]+)(\[.*|$)/u'],
            [['form_id', 'type', 'enable_view', 'sortOrder'], 'integer'],
            [['html_attributes_options', 'validation_rules', 'view_options'], 'string'],
            [['name', 'label', 'hint', 'parent_node_id'], 'string', 'max' => 255],
            [['form_id'], 'exist', 'skipOnError' => true, 'targetClass' => DynamicForm::className(), 'targetAttribute' => ['form_id' => 'id']],
            ['type', 'in', 'range'=> array_keys(InputHelper::inputs())],
            
        ];
        foreach ($html_rules as $rule) {
            $rules[]= $rule;
        }
        foreach ($search_rules as $rule) {
            $rules[]= $rule;
        }
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'form_id' => 'Form ID',
            'type' => 'Type',
            'name' => 'Name',
            'label' => 'Label',
            'html_attributes_options' => 'Html Attributes Options',
            'validation_rules' => 'Validation Rules',
            'enable_search' => 'Enable Search', 
            'search_options' => 'Search Options', 
            'enable_view' => 'Enable View', 
            'view_options' => 'View Options',
            'parent_node_id'=> 'Parent container ID'
        ];
    }
    
    public function attributeHints() {
        return[
            'enable_search' => 'Enable this input to be Searchable', 
            'enable_view' => 'Alllow this input value to View', 
        ];
    }

    public static function findOne($id) {
        $model = (new \yii\db\Query())
        ->select('type')
        ->from(static::tableName())
        ->where([static::primaryKey()[0] => $id])
        ->one();
        if($model['type']){
            $input_class_name = InputHelper::input($model['type'])['class'];
            return $input_class_name::find()->where(['id'=> $id])->one();
        }
        return parent::findOne($id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(DynamicForm::className(), ['id' => 'form_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getList() {
        return $this->hasOne(DynamicInputList::className(), ['input_id' => 'id']);
    }

    public function isListable() {
        return $this->type === InputHelper::CHECKBOX_LIST || $this->type === InputHelper::DROPDOWN_LIST || $this->type === InputHelper::RADIO_LIST;
    }
    
    public function getRelatedList() {
        if(!$this->list)
            return [];
        return $this->list->getItems();
    }
    
    public function getInputType() {
        return InputHelper::input($this->type)['title'];
    }
    
    public function getFinalValue() {
        if($this->type == InputHelper::CHECKBOX_LIST)
            return json_decode($this->value, true);
        else
            return $this->value;
    }
    
    public function getFormatedValue() {
        $value = $this->value ;
        
        switch ($this->type) {
            case InputHelper::DROPDOWN_LIST:
            case InputHelper::RADIO_LIST:
                if(array_key_exists($value, $this->getRelatedList()))
                    return $this->getRelatedList ()[$value];
                return null;
            case InputHelper::CHECKBOX_LIST:
                $value = json_decode($value, true);
                $new_value = [];
                $list = $this->getRelatedList();
                foreach ($value as $key) {
                    if(array_key_exists($key, $list))
                        $new_value[$key] = $list[$key];
                }
                return $new_value;
            default:
                return $value;
        }
    }

    public function setFinalValue($value) {
        if($this->type === InputHelper::CHECKBOX_LIST)
            $this->value =  json_encode ($value);
        else
            $this->value = $value;
    }
    
    public function getInputIcon() {
        return Html::tag('span', null, ['class'=> InputHelper::input($this->type)['icon']]);
    }
        
    /**
     * 
     * @param \yii\db\ActiveRecord $model
     */    
    public function getValidationsForModel($model){
        $validation_rules = Json::decode($this->validation_rules);
        $model_validator = $model->getValidators();
        foreach ($validation_rules as $rule => $options) {
            if(is_array($options)){
                $model_validator->append($this->addRule($model, $this->name, $rule, $options));
            }else{
                $model_validator->append($this->addRule($model, $this->name, $rule));
            }
        }
    }
    
    protected function addRule($model, $attributes, $validator, $options = []){
        return Validator::createValidator($validator, $model, (array) $attributes, $options);
    }   
    
    public function afterFind() {
        parent::afterFind();
        $this->setHtmlOptions();
        $this->setSearchOptions();
    }
    
    public function beforeSave($insert) {
        $this->html_attributes_options = json_encode($this->getHtmlOptions());
        $this->search_options = json_encode($this->getSearchOptions());
        return parent::beforeSave($insert);
    }
    
    /**
     * 
     * @param \yii\web\Request $data
     */
    public function loadValidators($validations_models, $data) {
        if(!method_exists($this, 'getValidatorsModels'))
            return;
        $validators = [];
        foreach ($validations_models as $validator_id => $options) {
            $options->load($data);
            $rule = $this->fetchValidatorRules($validator_id, $options);
            if(!$options->validate())
                return false;
            if($rule)
                $validators[$validator_id]= $rule;
                
        }
        $this->validation_rules = Json::encode($validators);
        return true;
    }
    
    public function fetchValidatorRules($validator_id, $options) {
        $rule = $options->getRule();
        if(is_array($rule))
            return $rule;
        elseif($rule == true)
            return true;            
    }
}
