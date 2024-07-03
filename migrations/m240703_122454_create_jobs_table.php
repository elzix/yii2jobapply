<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jobs}}`.
 */
class m240703_122454_create_jobs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%jobs}}', [
            'id' => $this->primaryKey(),
            'job_title' => Schema::TYPE_STRING . ' NOT NULL',
            'job_desc' => Schema::TYPE_TEXT,
            'deadline' => Schema::TYPE_DATETIME . ' NULL',
            'category' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_STRING . ' NOT NULL',
            'created' => Schema::TYPE_DATETIME . ' NOT NULL DEFAULT current_timestamp()',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%jobs}}');
    }
}
