<?php

use yii\db\Migration;
use \yii\db\Schema;

class m160411_131604_comments extends Migration
{
    public function up()
    {
        $this->createTable('{{%comments}}',[
            'id' =>Schema::TYPE_PK,
            'created_at' => Schema::TYPE_INTEGER . "(11) NULL",
            'updated_at' => Schema::TYPE_INTEGER . "(11) NULL",
            'status_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'parent_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'title' => Schema::TYPE_STRING . "(50) NOT NULL",
        ]);

        $this->createTable('{{%comments_fields}}',[
            'id' =>Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(30) NOT NULL",
            'description' => Schema::TYPE_STRING . "(100) NOT NULL",
        ]);

        $this->createTable('{{%comments_fields_value}}',[
            'comments_id' =>Schema::TYPE_INTEGER . "(11) NOT NULL",
            'comments_fields_id' => Schema::TYPE_INTEGER . "(11) NOT NULL",
            'value' => Schema::TYPE_STRING . "(250) NOT NULL",
        ]);

        $this->createTable('{{%comments_link}}',[
            'comments_id' =>Schema::TYPE_INTEGER . "(11) NOT NULL",
            'module_id' => Schema::TYPE_STRING . "(50) NOT NULL",
        ]);


        $this->createIndex('idx_parent_id','{{%comments}}','parent_id');
        $this->createIndex('idx_name','{{%comments_fields}}','name',true);
        $this->createIndex('idx_comments_id','{{%comments_fields_value}}','comments_id');
        $this->createIndex('idx_comments_fields_id','{{%comments_fields_value}}','comments_fields_id');


    }

    public function down()
    {
        $this->dropTable('{{%comments_link}}');
        $this->dropTable('{{%comments_fields_value}}');
        $this->dropTable('{{%comments_fields}}');
        $this->dropTable('{{%comments}}');
    }

}
