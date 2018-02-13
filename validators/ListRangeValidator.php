<?php
namespace wardany\dform\validators;
use yii\validators\RangeValidator;
use yii\base\InvalidConfigException;

class ListRangeValidator extends RangeValidator
{
    public function init(){
        try{
            parent::init();
        }catch(InvalidConfigException $e){
//            $input_model = ListField::findOne($this->input_id);
//            $this->input_model = $input_model;
        }
    }

    /**
     * @inheritdoc
     */
    public function validateAttribute($model, $attribute){
        $this->range= array_keys($model->getRelatedList($attribute));
        parent::validateAttribute($model, $attribute);
    }

    /**
     * @inheritdoc
     */
    public function clientValidateAttribute($model, $attribute, $view){
        
        $this->range= array_keys($model->getRelatedList($attribute));
        parent::clientValidateAttribute($model, $attribute, $view);
    }
}
?>
