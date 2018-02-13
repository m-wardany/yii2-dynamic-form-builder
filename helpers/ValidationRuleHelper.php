<?php
namespace wardany\dform\helpers;

use Yii;
use yii\validators\Validator;
use wardany\dform\validators_helpers;
/**
 * Description of ValidatioRuleHelper
 *
 * @author Muhammad Wardany <muhammad.wardany@gmail.com>
 */   
class ValidationRuleHelper extends \yii\base\Component{
    
    private $model;
    private $model_validator;
    private $old_validators;
    
    /**
     * 
     * @param \wardany\dform\models\DynamicFormInput $model
     * @param array $config
     */
    public function __construct($model, $config = array()) {
        $this->model = $model;
        $this->old_validators = $model->isNewRecord? []: \yii\helpers\Json::decode($model->validation_rules);
        parent::__construct($config);
    }
    
    public function reqired() {
        $model = new validators_helpers\RequiredValidatorHelper($this->old_validators);
        $this->addValidatorModel($model);
        return $this;
    }
    
    public function string($required= false) {
        $model = new validators_helpers\StringValidatorHelper($this->old_validators);
        $model->required = $required;
        $this->addValidatorModel($model);
        return $this;
    }
    
   public function compare($type = null) {
        $model = new validators_helpers\CompareValidatorHelper($this->old_validators);
        if($type !== null)
            $model->type = $type;
        $this->addValidatorModel($model);
        return $this;
    }
    
    public function url() {
        $model = new validators_helpers\UrlValidatorHelper($this->old_validators);
        $this->addValidatorModel($model);
        return $this;
    }
    
    public function email() {
        $model = new validators_helpers\EmailValidatorHelper($this->old_validators);
        $this->addValidatorModel($model);
        return $this;
    }
    
    public function number($required= false) {
        $model = new validators_helpers\NumberValidatorHelper($this->old_validators);
        $model->required = $required;
        $this->addValidatorModel($model);
        return $this;
    }
    
    public function range($allowArray= false) {
        $model = new validators_helpers\RangeValidatorHelper($this->old_validators);
        $model->allowArray = $allowArray;
        $this->addValidatorModel($model);
        return $this;
    }
    
    public function build() {
        return $this->model_validator;
    }
    
    protected function addValidatorModel($model) {
        $this->model_validator[$model::ID]= $model;
}
}
