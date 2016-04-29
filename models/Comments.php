<?php

namespace msdie\modules\comments\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "{{%comments}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status_id
 * @property integer $parent_id
 * @property string $title
 * @property string $text
 *
 * @property CommentsFields[] $commentsFields
 * @property CommentsLink $commentsLink
 */
class Comments extends \yii\db\ActiveRecord
{
    private $_fieldValue=null;

    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className()
            ]
        ];
    }
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
        $rules = [
            [['created_at', 'updated_at', 'status_id', 'parent_id'], 'integer'],
            [[ 'text'], 'required', 'message' => 'Поле «{attribute}» обязательно к заполнению'],
            [['title'], 'string', 'max' => 50],
            [['text'], 'string', 'max' => 300],
        ];

        if(\Yii::$app->user->isGuest)
            $rules = array_merge($rules,[['title','required', 'message' => 'Поле «{attribute}» обязательно к заполнению']]);
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Дата редактирования',
            'status_id' => 'Статус',
            'parent_id' => 'Parent ID',
            'title' => 'Имя',
            'text' => 'Комментарий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentsFields()
    {
        return $this->hasMany(CommentsFields::className(), ['comments_id' => 'id']);
    }

    public function getFieldsReindex()
    {
        if($this->_fieldValue === null) {
            $fields = \Yii::$app->getModule('comments')->fields;
            if(!empty($fields)) {
                if ($this->commentsFields != null) {
                    $fieldsValue = \yii\helpers\ArrayHelper::map($this->commentsFields, 'field_name', 'value');
                    foreach ($fields as $field) {
                        $this->_fieldValue[$field['name']] = [
                            'label' => $field['label'],
                            'value' => isset($fieldsValue[$field['name']]) ? $fieldsValue[$field['name']] : '',
                        ];
                    }
                } else {
                    foreach ($fields as $field) {
                        $this->_fieldValue[$field['name']] = [
                            'label' => $field['label'],
                            'value' => '',
                        ];
                    }
                }
            }
            else $this->_fieldValue=[];
        }
        return $this->_fieldValue;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentsLink()
    {
        return $this->hasOne(CommentsLink::className(), ['comments_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getPageUrl()
    {
        return $this->commentsLink->url;
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            $this->text = HtmlPurifier::process($this->text);
            $this->title = HtmlPurifier::process($this->title);
            return true;
        }
        return false;
    }
}
