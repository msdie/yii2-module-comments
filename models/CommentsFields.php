<?php

namespace app\vendor\msdie\modules\comments\models;

use Yii;

/**
 * This is the model class for table "{{%comments_fields}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 */
class CommentsFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comments_fields}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 100],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }
}
