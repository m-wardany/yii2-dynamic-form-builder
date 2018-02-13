<?php
namespace wardany\dform\helpers;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
class ActionHelper{
    public static function getAllFilesAsArray() {
        $files = self::getAllFiles();
        $files_array=[];
        foreach ($files as $file) {
            $class_name = StringHelper::basename(ClassNameHelper::get_class_from_file($file));
            $files_array[lcfirst(Inflector::id2camel($class_name))] = $class_name;
        }
        return $files_array;
    }

    public static function getActions() {
        $files = self::getAllFiles();
        $files_array=[];
        foreach ($files as $file) {
            $class_name = ClassNameHelper::get_class_from_file($file);
            $files_array[lcfirst(Inflector::id2camel(StringHelper::basename($class_name)))] = $class_name;
        }
        return $files_array;
    }

    public static function getActionsNames() {
        $files = self::getAllFiles();
        $actions=[];
        foreach ($files as $file) {
            $class_name = ClassNameHelper::get_class_from_file($file);
            $actions[] = lcfirst(Inflector::id2camel(StringHelper::basename($class_name)));
        }
        return $actions;
    }

    public static function getAllFiles() {
        $module = Yii::$app->getModule('dynamic_form_builder');
        return FileHelper::findFiles(Yii::getAlias($module->dynamic_actions_path),['only'=>['*.php']]);
    }

    public static function getActionData($action_url) {
        $ch = curl_init($action_url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        curl_close($ch);
        return self::isJson($data)? $data: json_encode([]);
    }


    public static function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

 ?>
