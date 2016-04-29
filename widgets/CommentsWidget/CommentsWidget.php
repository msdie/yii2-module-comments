<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 13.04.16
 * Time: 9:54
 */

namespace msdie\modules\comments\widgets\CommentsWidget;

use msdie\modules\comments\models\Comments;
use yii\base\Widget;
use yii\db\Exception;
use yii\helpers\Html;
use yii\helpers\Url;

class CommentsWidget extends Widget
{
    public $model;
    public $showForm=true;
    public $view = 'index';
    public $title='Отзывы';
    public $dontShowFields=[];
    public $url;
    public $conditionLinkParams=null;
    public $linkParams=null;
    private $_id='form-comment';
    private $_comments;
    private $_action;

    public function init()
    {
        parent::init();

        if($this->model == null){
            $this->model = new \msdie\modules\comments\models\CommentForm();
//            $this->model->url=\Yii::$app->request->absoluteUrl;
        }


        if($this->conditionLinkParams == null) {
            $this->_comments = Comments::find()->where(['comments_link.url'=>\Yii::$app->request->absoluteUrl,'status_id'=>1])->joinWith('commentsLink')->all();
        }
        else {
            $this->_comments = Comments::find()->where(['comments_link.link_params' => $this->conditionLinkParams,'status_id'=>1])->joinWith('commentsLink')->all();
            if($this->linkParams==null)
                $this->linkParams = is_array($this->conditionLinkParams)?$this->conditionLinkParams[0]:$this->conditionLinkParams;
        }

        $this->_action = Url::toRoute(['/comments/default/add','url'=>\Yii::$app->request->absoluteUrl,'link_params'=>$this->linkParams]);

    }

    public function run()
    {
        return $this->render($this->view,[
            'model' => $this->model,
            'showForm' =>$this->showForm,
            'title' => $this->title,
            'id'=>$this->_id,
            'comments' => $this->_comments,
            'action' => $this->_action,
            'dontShowFields' => $this->dontShowFields,
        ]);
    }
}