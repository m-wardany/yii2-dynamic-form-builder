<?php

use yii\db\Migration;

/**
 * Class m180206_094518_add_more_features_to_inputs_table
 */
class m180206_094518_add_more_features_to_inputs_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('dynamic_form_inputs', 'hint', $this->string());
        $this->addColumn('dynamic_form_inputs', 'parent_node_id', $this->string());
        $this->addColumn('dynamic_form_inputs', 'sortOrder', $this->integer()->unsigned());                
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('dynamic_form_inputs', 'hint');
        $this->dropColumn('dynamic_form_inputs', 'parent_node_id');
        $this->dropColumn('dynamic_form_inputs', 'sortOrder');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180206_094518_add_more_features_to_inputs_table cannot be reverted.\n";

        return false;
    }
    */
}
