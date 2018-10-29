<?php

use yii\db\Migration;

/**
 * Handles adding profile to table `user`.
 */
class m181028_003738_add_profile_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'description', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'description');
    }
}
