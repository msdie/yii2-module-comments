<?php

use yii\db\Migration;
use \yii\db\Schema;

class m160411_131604_comments extends Migration
{
    public $tableOptions='ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci';
    public function up()
    {
        $this->createTable('{{%comments}}',[
            'id' =>Schema::TYPE_PK,
            'created_at' => Schema::TYPE_INTEGER . "(11) NULL",
            'updated_at' => Schema::TYPE_INTEGER . "(11) NULL",
            'status_id' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT 0",
            'parent_id' => Schema::TYPE_INTEGER . "(11) NOT NULL DEFAULT 0",
            'title' => Schema::TYPE_STRING . "(50) NOT NULL",
            'text' => Schema::TYPE_STRING . "(300) NOT NULL",
        ],$this->tableOptions. " COMMENT = 'Таблица комментариев'");


        $this->createTable('{{%comments_fields}}',[
            'comments_id' =>Schema::TYPE_INTEGER . "(11) NOT NULL",
            'field_name' => Schema::TYPE_STRING . "(15) NOT NULL",
            'value' => Schema::TYPE_STRING . "(250) NOT NULL",
            'PRIMARY KEY (comments_id,field_name)',
        ],$this->tableOptions. " COMMENT = 'Таблица с дополнительными полями для коментариев'");

        $this->createTable('{{%comments_link}}',[
            'comments_id' =>Schema::TYPE_INTEGER . "(11) NOT NULL",
            'url' => Schema::TYPE_STRING . "(250) NOT NULL",
            'link_params' => Schema::TYPE_STRING . "(250)",
            'user_id' =>Schema::TYPE_INTEGER . "(11) NULL",
            'PRIMARY KEY (comments_id)',
        ],$this->tableOptions. " COMMENT = 'Таблица привязки комментариев к ссылке, пользователю и по параметрам'");


        $this->createIndex('idx_parent_id','{{%comments}}','parent_id');
        $this->createIndex('idx_comments_id','{{%comments_fields}}','comments_id');
        $this->createIndex('idx_field_name','{{%comments_fields}}','field_name');
        $this->createIndex('idx_link_params','{{%comments_link}}','link_params');
        $this->createIndex('idx_url','{{%comments_link}}','url');
//        $this->execute('set foreign_key_checks=0;');
        $this->addForeignKey('fk_comments_link_comments_id','{{%comments_link}}','comments_id','{{%comments}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk_comments_fields_comments_id','{{%comments_fields}}','comments_id','{{%comments}}','id','CASCADE','CASCADE');
//        $this->execute('set foreign_key_checks=1;');

    }

    public function down()
    {
        $this->execute('set foreign_key_checks=0;');
        $this->dropTable('{{%comments_link}}');
        $this->dropTable('{{%comments_fields}}');
        $this->dropTable('{{%comments}}');
        $this->execute('set foreign_key_checks=1;');
    }

}
