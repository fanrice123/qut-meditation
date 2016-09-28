<?php
namespace backend\controllers;

use common\models\Course;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\AdminLoginForm;
use common\models\CreateCourseForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'course'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        $test = new Course();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCourse()
    {
        $model = new CreateCourseForm();

        if ($model->load(Yii::$app->request->post())) {
           if ($model->createCourse()) {
                // form inputs are valid, do something here
               Yii::$app->session->setFlash('success', 'You have successfully create a class starting on '
                                                        .$model->start.' with duration of '.$model->duration.' day'
                                                        .($model->duration == 1 ? '.' : 's.')
               );
            } else {
               Yii::$app->session->setFlash('danger', 'Course creating failed, please recheck your input(s). '
                                                      .'If you assure that the inputs are valid, please contact database administrator.');
           }
        }
        return $this->render('course', [
            'model' => $model,
        ]);
    }


}


