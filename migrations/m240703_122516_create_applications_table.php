<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%applications}}`.
 */
class m240703_122516_create_applications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%applications}}', [
            'id' => $this->primaryKey(),
            'job' => Schema::TYPE_INTEGER . ' NOT NULL',
            'fname' => Schema::TYPE_STRING . ' NOT NULL',
            'lname' => Schema::TYPE_STRING . ' NOT NULL',
            'cv' => Schema::TYPE_STRING . ' NOT NULL',
            'letter' => Schema::TYPE_STRING . ' NOT NULL',
            'created' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT current_timestamp()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%applications}}');
    }
}
