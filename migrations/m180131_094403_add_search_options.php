<?php

use yii\db\Migration;

/**
 * Class m180131_094403_add_search_options
 */
class m180131_094403_add_search_options extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        $json_type = $this->db->driverName === 'mysql'? 'JSON':$this->text();
        $this->addColumn('dynamic_form_inputs', 'enable_search', $this->boolean());
        $this->addColumn('dynamic_form_inputs', 'search_options', $json_type);
        $this->addColumn('dynamic_form_inputs', 'enable_view', $this->boolean()->defaultValue(true));
        $this->addColumn('dynamic_form_inputs', 'view_options', $json_type);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('dynamic_form_inputs', 'enable_search');
        $this->dropColumn('dynamic_form_inputs', 'search_options');
        $this->dropColumn('dynamic_form_inputs', 'enable_view');
        $this->dropColumn('dynamic_form_inputs', 'view_options');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180131_094403_add_search_options cannot be reverted.\n";

        return false;
    }
    */
}
