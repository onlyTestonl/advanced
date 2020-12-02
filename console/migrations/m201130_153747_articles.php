<?php

use yii\db\Migration;

/**
 * Class m201130_153747_articles
 */
class m201130_153747_articles extends Migration
{



    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('articles', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200),
            'text' => $this->string(),
            'author_id' => $this->integer(),
            'alias'=> $this->string(200),
            'data'=>$this->date("Y-m-d"),
            'likes'=>$this->integer(),
            'hits'=>$this->integer(),

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201130_153747_articles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201130_153747_articles cannot be reverted.\n";

        return false;
    }
    */
}
