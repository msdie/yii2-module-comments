<?php

namespace msdie\modules\comments\models;

use Yii;

/**
 * This is the model class for table "{{%comments_link}}".
 *
 * @property integer $comments_id
 * @property string $url
 * @property string $link_params
 * @property integer $user_id
 *
 * @property Comments $comments
 */
class CommentsLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comments_link}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comments_id', 'url'], 'required'],
            [['comments_id', 'user_id'], 'integer'],
            [['url', 'link_params'], 'string', 'max' => 250],
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
            'url' => 'Url',
            'link_params' => 'Link Params',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasOne(Comments::className(), ['id' => 'comments_id']);
    }

    public function getUser()
    {
        $userClass=\Yii::$app->getModule('comments')->userClass;
        return $this->hasOne($userClass::className(),['id' => 'user_id']);
    }
}
