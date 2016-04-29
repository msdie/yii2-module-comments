<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\comments\models\Comments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comments-form">

    <?php $form = ActiveForm::begin(['enableClientValidation'=>true,]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'status_id')->dropDownList([0=>'Выключен',1=>'Включен'])->label('Статус') ?>


    <?php

    foreach ($model->fields as $key => $field)
    {
        switch ($field['fieldType'])
        {
            case 'textarea':
                echo $form->field($model, $field['name'])->textarea($field['options']);
                break;
            case 'dropDown':
                echo $form->field($model, $field['name'])->dropDownList($field['items'],$field['options']);
                break;
            default:
                echo $form->field($model, $field['name'])->textInput($field['options']);
                break;
        }
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
