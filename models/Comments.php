<?php

namespace app\vendor\msdie\modules\comments\models;

use Yii;

/**
 * This is the model class for table "{{%comments}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status_id
 * @property integer $parent_id
 * @property string $title
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'status_id', 'parent_id'], 'integer'],
            [['status_id', 'parent_id', 'title'], 'required'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status_id' => 'Status ID',
            'parent_id' => 'Parent ID',
            'title' => 'Title',
        ];
    }
}
