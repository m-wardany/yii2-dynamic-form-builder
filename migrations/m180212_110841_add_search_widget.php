<?php

use yii\db\Migration;

/**
 * Class m180212_110841_add_search_widget
 */
class m180212_110841_add_search_widget extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(){
        $this->addColumn('dynamic_form_inputs', 'search_widget', $this->smallInteger());
    }

    /**
     * @inheritdoc
     */
    public function safeDown(){        
        $this->dropColumn('dynamic_form_inputs', 'search_widget');
    }
}
