<?php

namespace wardany\dform\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "dynamic_form".
 *
 * @property int $id
 * @property string $title
 * @property string $note
 * @property string $extra_validation_rules
 * @property string $custom_form_file
 * @property string $custom_search_file
 * @property string $custom_view_file
 *
 * @property DynamicFormInputs[] $inputs
 */
class DynamicForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dynamic_form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['note', 'extra_validation_rules'], 'string'],
            [['title', 'custom_form_file', 'custom_search_file', 'custom_view_file'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'note' => 'Note',
            'extra_validation_rules' => 'Extra Validation Rules',
            'custom_form_file' => 'Custom Form File',
            'custom_search_file' => 'Custom Search File',
            'custom_view_file' => 'Custom View File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDynamicFormInputs()
    {
        return $this->hasMany(DynamicFormInputs::className(), ['form_id' => 'id']);
    }
    
    public function getCustomFormFiles() {
        return $this->getFilesFromDir('custom_form_files_path');
    }
    
    public function getCustomViewFiles() {
        return $this->getFilesFromDir('custom_view_files_path');
    }
    
    public function getCustomSearchFiles() {
        return $this->getFilesFromDir('custom_search_files_path');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInputs()
    {
        return $this->hasMany(DynamicFormInput::className(), ['form_id' => 'id']);
    }
    
    public function drawValidationRules($model) {
        $validations=[];
        foreach ($this->inputs as $input) {
            $input->getValidationsForModel($model);
        }
    }
    
    /**
     * 
     * @param String $path_string
     * @return array
     */
    public function getFilesFromDir($path_string) {
        $module = Yii::$app->getModule('dynamic_form_builder');
        $path = Yii::getAlias($module->{$path_string});
        if(is_dir($path)){
            $files = FileHelper::findFiles($path,['only'=>['*.php']]);
            $files_array =[];
            foreach ($files as $file) {
                $files_array[ pathinfo ($file,PATHINFO_BASENAME)]= pathinfo ($file, PATHINFO_FILENAME);
            }
            return $files_array;
        }
        return [];
    }
}
