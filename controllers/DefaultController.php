<?php

namespace msdie\modules\comments\controllers;

use msdie\modules\comments\models\CommentsFields;
use msdie\modules\comments\models\CommentsLink;
use msdie\modules\comments\models\CommentForm;
use Yii;
use msdie\modules\comments\models\Comments;
use msdie\modules\comments\models\CommentsSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Default controller for the `comments` module
 */
class DefaultController extends Controller
{
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
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CommentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comments model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Comments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Коментарий сохранен.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else    Yii::$app->getSession()->setFlash('error', 'При сохранении комментария возникли ошибки.');
        }

            return $this->render('update', [
                'model' => $model,
            ]);

    }


    public function actionAdd($url,$link_params=null)
    {
        $commentForm = new CommentForm(['url' => $url, 'link_params' => $link_params]);

        if(Yii::$app->request->isAjax)
        {
            $commentForm->ajaxValidation();
        }

        if ($commentForm->load(\Yii::$app->request->post()) && $commentForm->validate()) {

            if($commentForm->save())
            {
                if(\Yii::$app->request->isAjax)
                    return 'success';
                else {
                    \Yii::$app->session->setFlash('success','Коментарий добавлен.');
                }
            }

        }
        else {
            \Yii::$app->session->setFlash('error','Ошибка. Комментарий не добавлен.');
        }
        $this->redirect($url);

    }


    protected function findModel($id)
    {
        if (($model = CommentForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
