<?php

namespace wardany\dform\behaviors;

use wardany\dform\helpers\InputHelper;
use yii\base\UnknownPropertyException;
use yii\db\Expression;
use yii\db\Query;
use yii\validators\Validator;

/**
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */
class DynamicFormSearchBehavior extends DynamicFormBuilderBehavior{
    
    const RANGE_FROM_DELIMITER = 'from_';
    const RANGE_TO_DELIMITER = 'to_';
    
    public $values_table;
    public $relation_input;

    public function events() {
        return[
            \yii\db\BaseActiveRecord::EVENT_INIT => 'start',
        ];
    }
    
    public function attachAllAttributes($searchable_only = true) {
            parent::attachAllAttributes(true);
    }
    
    public function getSearchableAttributes() {
        return $this->extra_attributes;
    }
    
    public function attachValidators() {
        foreach ($this->extra_attributes as $attribute_name => $model) {
            switch ($model->search_widget) {
                case InputHelper::CHECKBOX_LIST:
                case InputHelper::RANGE_INPUT:
                    $this->owner->getValidators()->append(Validator::createValidator('safe', $this->owner, $attribute_name));
                    break;
                case InputHelper::TEXT_INPUT:
                case InputHelper::TEXT_AREA:
                    $this->owner->getValidators()->append(Validator::createValidator('string', $this->owner, $attribute_name));
                    break;
                default:
                    $this->owner->getValidators()->append(Validator::createValidator('integer', $this->owner, $attribute_name));
                    break;
            }
        }
    }
    
    /**
     * 
     * @param \wardany\dform\models\DynamicFormInput $model
     * @param String $attribute_name
     * @return array [min, max, from, to]
     */
    public function getRangeInputValues($input, $attribute_name) {
        $query = (new Query)->where(['input_id'=> $input->id])->from($this->values_table);        
        $value= explode(';', $this->getExtraAttributeValue($attribute_name));
        
        $min = floor($query->min('CAST(`value` AS UNSIGNED)') / 10) * 10;
        $max = ceil($query->max('CAST(`value` AS UNSIGNED)') / 10) * 10;
        $from = isset($value[0], $value[1])? $value[0]: $min;
        $to = isset($value[1])? $value[1]: $max;
        return ['min'=> $min, 'max'=> $max, 'from'=> $from, 'to'=> $to];
    }
    
    /**
     * 
     * @param \yii\db\ActiveQuery $query
     */
    public function searchExtraAttributes($query) {
        $searches = 0;
        $ids=[];
        foreach ($this->extra_attributes as $attribute_name => $model) {
            $id = $model->id;
            $value = $this->getExtraAttributeValue($attribute_name);
            if($value){
                $searches++;
                $criteria = $this->buildCriteria($model, $attribute_name, $id);
                $criteria->from($this->values_table);
                if($ids)
                    $criteria->andWhere ([$this->relation_input => $ids]);
                $ids = $criteria->column();
                if(!count($ids))
                    break;
            }
        }
        if(count($ids)){
            $query->andFilterWhere(['id'=> $ids]);
        }
        elseif($searches>0){
            $query->where (['id'=> 0]);
        }
    }
    
    private function buildCriteria($model, $attribute_name, $input_id) {
        $query =  (new Query())
            ->select($this->relation_input)
            ->where(['input_id'=> $input_id]);
        switch ($model->search_widget) {
            case InputHelper::CHECKBOX_LIST:
                $value = json_encode($this->{$attribute_name});
                $expression = new Expression("JSON_CONTAINS(value, '$value')");
                $query->andWhere($expression);
                break;
            case InputHelper::TEXT_INPUT:
                $query->andFilterWhere(['like', 'value', $this->{$attribute_name}]);
                break;            
            case InputHelper::RANGE_INPUT:
                $value= $this->getRangeInputValues($model, $attribute_name);
                $query->andFilterWhere(['between', 'CAST(`value` AS UNSIGNED)', $value['from'], $value['to']]);
                break;
            default:
                $query->andFilterWhere(['value' => $this->{$attribute_name}]);
                break;
        }
        return $query;
    }
}
