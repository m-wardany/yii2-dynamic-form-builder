<?php

use yii\db\Migration;

/**
 * Class m180118_160405_create_base_tables
 */
class m180118_160405_create_base_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        $json_type = $this->db->driverName === 'mysql'? 'JSON':$this->text();
//        $module = Yii::$app->getModule('dynamic_form_builder');
        $form_table = 'dynamic_form'; 
        $inputs_table = 'dynamic_form_inputs'; 
        if ($this->db->driverName === 'mysql') 
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                
        $this->createTable($form_table, [
            'id' => $this->primaryKey(),
            'title'=>  $this->string()->notNull(),
            'note'=> $this->text(),
            'extra_validation_rules'=> $json_type,
            'custom_form_file'=>  $this->string(),
            'custom_search_file'=> $this->string(),
            'custom_view_file'=> $this->string(),
        ], $tableOptions);
        
        $this->createTable($inputs_table, [ 
            'id'=>  $this->primaryKey(),
            'form_id'=>  $this->integer()->notNull(),
            'type'=> $this->integer()->notNull(),
            'name'=> $this->string(),
            'label'=> $this->string(),
            'html_attributes_options'=> $json_type,
            'validation_rules'=> $json_type            
        ], $tableOptions);
        
        $this->addForeignKey('dynamic_form_inputs_fk', $inputs_table, 'form_id', $form_table, 'id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $module = Yii::$app->getModule('dynamic_form_builder');
        $form_table = $module->dynamic_form_table; 
        $inputs_table = $module->dynamic_form_inputs_table; 
        $this->dropForeignKey('dynamic_form_inputs_fk', $inputs_table);
        $this->dropTable($inputs_table);
        $this->dropTable($form_table);
    }
}
