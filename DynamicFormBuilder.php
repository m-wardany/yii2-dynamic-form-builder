<?php

namespace wardany\dform;
use yii\base\InvalidConfigException;

/**
 * dynamic_form module definition class
 */
class DynamicFormBuilder extends \yii\base\Module
{

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'wardany\dform\controllers';

    public $dynamic_form_table = 'dynamic_form';
    public $dynamic_form_inputs_table = 'dynamic_form_inputs';
    public $allowI18n = true;
    public $translationCategory = 'dform';
    public $custom_form_files_path = '@frontend/views/dynamic_forms/forms';
    public $custom_view_files_path = '@frontend/views/dynamic_forms/views';
    public $custom_search_files_path = '@frontend/views/dynamic_forms/search';
    public $extra_validation_path = '@common/validators';
    public $dynamic_actions_controller = 'site';
    public $dynamic_actions_path = '@frontend/actions';
    public $upload_path;
    public $upload_url;

}
