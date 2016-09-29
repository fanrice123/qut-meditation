<?php

namespace frontend\controllers;

use frontend\models\SignupForm;
use Yii;
use common\models\User;
use common\models\UserForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Displays a single User model.
     * @return mixed
     */
    public function actionView()
    {
        $backModel = $this->findModel(Yii::$app->user->id);
        $model = new UserForm();
        $model->copyGeneralFrom($backModel);
        if ($model->load(Yii::$app->request->post()) && $model->updateGeneralTo($backModel)) {
            //$model->copyValueTo($backModel);
            Yii::$app->session->setFlash('kv-detail-success', 'Saved record successfully');
            // Multiple alerts can be set like below
            Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            return $this->redirect(['view', 'model'=>$model]);
        } else {
            Yii::$app->session->setFlash('kv-detail-danger', 'Failed to load data.');
            return $this->render('view', ['model'=>$model]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
