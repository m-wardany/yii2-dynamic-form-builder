# Dynamic Form Builder for yii2
Dynamic form builder is a full module to inject new attributes to any model you want, and you can manipulate this new attributes in the backend, and many other features.

  - add server/client side validations
  - determine searchable attributes
  - select the desired widget or input to be displayed in the form or search
  - easy to search

### Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist wardany/dynamic-form-builder "*"
```

or add

```
"wardany/dynamic-form-builder": "*"
```

to the require section of your `composer.json` file.

run migration
```
php yii migrate --migrationPath=@wardany/dform/migrations
```

add to your backend/config
```
'modules' => [
        'dynamic_form_builder' => [
            'class' => 'wardany\dform\DynamicFormBuilder',
        ],
],
```
now you can start add forms by going to the link `/dynamic_form_builder/forms/index`.

### Create models
to start use the form builder, for example you need to add attributes to the model __Post__
 - first create values table eg. '__posts_values__', this table must contains the following columns:
  -- input_id (integer) // you may need to create foreign key to the table 'dynamic_form_inputs'
  -- value (text / json)
 - add relation to the `Post` model :
    ```
    public function getValues(){
        return $this->hasMany(\wardany\dform\models\DynamicForm::className(), ['id' => 'input_id'])
            ->viaTable('post_values', ['post_id'=> 'id']);
    }
    ```
  - add `DynamicFormBuilderBehavior` to the Model
    ```
      public function behaviors() {
            return[
                ...
                \wardany\dform\behaviors\DynamicFormBuilderBehavior::className(),
                ...
            ];
        }
    ```
  - in the form page call the form drower widget
    ```
    <?= wardany\dform\widgets\InputViewerWidget::widget(['model'=> $model, 'form'=> $form]) ?>
    ```
  - add `DynamicFormSearchBehavior` to the search model
    ```
      public function behaviors() {
            return[
                ...
                [
                    'class'=> \wardany\dform\behaviors\DynamicFormSearchBehavior::className(),
                    'values_table'=> PostValues::tableName(),
                    'relation_input'=> 'post_id'
                ]
                ...
            ];
        }
    ```
  - in the form page call the form drower widget
    ```
    <?= wardany\dform\widgets\SearchViewerWidget::widget(['model'=> $model, 'form'=> $form]) ?>
    ```