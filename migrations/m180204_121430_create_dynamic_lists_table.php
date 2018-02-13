<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dynamic_lists`.
 */
class m180204_121430_create_dynamic_lists_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') 
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $json_type = $this->db->driverName === 'mysql'? 'JSON':$this->text();
        
        $this->createTable('dynamic_inputs_lists', [
            'id' => $this->primaryKey(),
            'input_id'=> $this->integer(),
            'list_type'=> $this->smallInteger(),
            'data_items'=> $json_type,
            'data_action'=> $this->string()
        ], $tableOptions);
    
        $this->addForeignKey('fk_dala_list_input', 'dynamic_inputs_lists', 'input_id', 'dynamic_form_inputs', 'id', 'CASCADE', 'CASCADE');
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk_dala_list_input', 'dynamic_inputs_lists');
        $this->dropTable('dynamic_inputs_lists');
    }
}
