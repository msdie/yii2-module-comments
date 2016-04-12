<?php

namespace app\vendor\msdie\modules\comments\models;

use Yii;

/**
 * This is the model class for table "{{%comments_fields_value}}".
 *
 * @property integer $comments_id
 * @property integer $comments_fields_id
 * @property string $value
 */
class CommentsFieldsValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comments_fields_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comments_id', 'comments_fields_id', 'value'], 'required'],
            [['comments_id', 'comments_fields_id'], 'integer'],
            [['value'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comments_id' => 'Comments ID',
            'comments_fields_id' => 'Comments Fields ID',
            'value' => 'Value',
        ];
    }
}
