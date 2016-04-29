<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model msdie\modules\comments\models\Comments */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => array_merge([
            'id',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],
            [
                'attribute' => 'status_id',
                'value' => $model->status_id==1?'Включен':'Выключен'
            ],
            [
                'attribute' => 'pageUrl',
                'label' => 'URL страницы',
                'format' => 'html',
                'value' => '<a data-pjax=0 href="'.$model->pageUrl.'" target="_blank">'.Html::encode($model->pageUrl).'</a>',
            ],
            'title',
            'text',
        ],$model->fields_names),
    ]) ?>

</div>
