<?php

namespace msdie\modules\comments\models;

use Yii;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "{{%comments_fields}}".
 *
 * @property integer $comments_id
 * @property integer $field_name
 * @property string $value
 *
 * @property Comments $comments
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
            [['comments_id', 'field_name', 'value'], 'required'],
            [['comments_id'], 'integer'],
            [['field_name'], 'string', 'max' => 15],
            [['value'], 'string', 'max' => 250],
            [['comments_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comments::className(), 'targetAttribute' => ['comments_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'comments_id' => 'Comments ID',
            'field_name' => 'Field Name',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasOne(Comments::className(), ['id' => 'comments_id']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $this->value = HtmlPurifier::process($this->value);
            return true;
        }
        return false;
    }
}
