<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel msdie\modules\comments\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Comments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id',
                'headerOptions' => ['width' => '80'],
            ],
             'text',
            [
                'attribute' => 'pageUrl',
                'format' => 'raw',
                'label' => 'URL страницы',
                'value' => function($model){
                    return '<a data-pjax=0 href="'.$model->pageUrl.'" target="_blank">'.$model->pageUrl.'</a>';
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
                'headerOptions' => ['width' => '150'],
            ],

            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
                'headerOptions' => ['width' => '150'],
            ],
            [
                'attribute' => 'status_id',
                'format' => 'raw',
                'headerOptions' => ['width' => '95'],
                'filter'=>array("1"=>"Вкл","0"=>"Выкл"),
                'value' => function($model){
                    return $model->status_id==1 ? '<span class="btn btn-success glyphicon glyphicon-ok-sign" title="Включен"></span>': '<span class="btn btn-danger glyphicon glyphicon-remove-sign" title="Выключен"></span>';
                },
            ],
//            'parent_id',
            // 'title',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>  '{view} {edit} {delete}',
                'headerOptions' => ['width' => '150'],
                'buttons'=>[
                    'view'=> function ($url, $model, $key) {
                        return Html::a('<span class="btn btn-primary glyphicon glyphicon-eye-open" title="Просмотр"></span>', \yii\helpers\Url::to(['default/view', 'id' => $model->id]));
                    },
                    'edit'=> function ($url, $model, $key) {
                        return Html::a('<span class="btn btn-primary glyphicon glyphicon-pencil" title="Изменить"></span>', \yii\helpers\Url::to(['default/update', 'id' => $model->id]));
                    },
                    'delete'=> function ($url, $model, $key) {
                        return Html::a('<span class="btn btn-danger glyphicon glyphicon-remove" title="Удалить"></span>', \yii\helpers\Url::to(['default/delete', 'id' => $model->id]));
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
