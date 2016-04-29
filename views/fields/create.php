<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\comments\models\CommentsFields */

$this->title = 'Create Comments Fields';
$this->params['breadcrumbs'][] = ['label' => 'Comments Fields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comments-fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
