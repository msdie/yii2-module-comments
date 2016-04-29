<?php

namespace msdie\modules\comments\controllers;

use Yii;
use msdie\modules\comments\models\CommentsFields;
use msdie\modules\comments\models\CommentsFieldsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FieldsController implements the CRUD actions for CommentsFields model.
 */
class FieldsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CommentsFields models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CommentsFieldsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CommentsFields model.
     * @param integer $comments_id
     * @param integer $field_name
     * @return mixed
     */
    public function actionView($comments_id, $field_name)
    {
        return $this->render('view', [
            'model' => $this->findModel($comments_id, $field_name),
        ]);
    }

    /**
     * Creates a new CommentsFields model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CommentsFields();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'comments_id' => $model->comments_id, 'field_name' => $model->field_name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CommentsFields model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $comments_id
     * @param integer $field_name
     * @return mixed
     */
    public function actionUpdate($comments_id, $field_name)
    {
        $model = $this->findModel($comments_id, $field_name);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'comments_id' => $model->comments_id, 'field_name' => $model->field_name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CommentsFields model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $comments_id
     * @param integer $field_name
     * @return mixed
     */
    public function actionDelete($comments_id, $field_name)
    {
        $this->findModel($comments_id, $field_name)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CommentsFields model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $comments_id
     * @param integer $field_name
     * @return CommentsFields the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($comments_id, $field_name)
    {
        if (($model = CommentsFields::findOne(['comments_id' => $comments_id, 'field_name' => $field_name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
