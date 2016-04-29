<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 13.04.16
 * Time: 9:55
 */
use yii\widgets\ActiveForm;
use yii\helpers\Html;

//\msdie\modules\comments\widgets\CommentsWidget\assets\CommentsWidgetAssets::register($this);
?>
    <div class="row">
        <div class="col-md-6 comments">
            <div><?= $title ?></div>
            <?php if ($showForm) { ?>
                <div class="comments-form">
                    <?php
                    $form = ActiveForm::begin([
                        'action' => $action,
                        'enableClientValidation' => true,
//                        'enableAjaxValidation' =>true,
                        'id' => $id,
                    ]); ?>

                    <?php
                    if (\Yii::$app->user->isGuest && !in_array('title', $dontShowFields))
                        echo $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'form-control acf'])->label('Имя')
                    ?>

                    <?= !in_array('text', $dontShowFields) ? $form->field($model, 'text')->textarea(['maxlength' => true, 'class' => 'form-control acf'])->label('Комментарий') : '' ?>
                    <?php

                    foreach ($model->fields as $key => $field) {
                        if (!in_array($field['name'], $dontShowFields)) {
                            $field['options'] = array_merge($field['options'], ['class' => 'form-control acf']);
                            switch ($field['fieldType']) {
                                case 'textarea':
                                    echo $form->field($model, $field['name'])->textarea($field['options']);
                                    break;
                                case 'dropDown':
                                    echo $form->field($model, $field['name'])->dropDownList($field['items'], $field['options']);
                                    break;
                                default:
                                    echo $form->field($model, $field['name'])->textInput($field['options']);
                                    break;
                            }
                        }
                    }
                    ?>

                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end();
                    ?>
                </div>
            <?php } ?>
            <div class="comments-list">
                <?php
                foreach ($comments as $comment) {
                    if (!in_array('title', $dontShowFields)) {
                        echo \yii\helpers\Html::activeLabel($model, 'title') . ':' . ($comment->commentsLink->user_id == 0 ? $comment->title : $comment->commentsLink->user->username);
                    }
                    if (!in_array('text', $dontShowFields))
                        echo '<br/>' . \yii\helpers\Html::activeLabel($model, 'text') . ':' . $comment->text;
                    foreach ($comment->fieldsReindex as $key => $field) {
                        if (!in_array($key, $dontShowFields)) {
                            echo '<br/>' . \yii\helpers\Html::label($field['label']) . ': ';
                            echo $field['value'];
                        }
                    }
                    echo '<hr/>';
                }
                ?>
            </div>
        </div>
    </div>





