<?php

namespace backend\controllers;

use common\models\Course;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\AdminLoginForm;
use common\models\CreateCourseForm;
use common\models\Report;
use backend\models\EmailForm;
use yii\web\Response;
use yii\db\Query;
use common\models\User;
use yii\helpers\ArrayHelper;

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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'course', 'report', 'write-email'],
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
                    . $model->start . ' with duration of ' . $model->duration . ' day'
                    . ($model->duration == 1 ? '.' : 's.')
                );
            } else {
                Yii::$app->session->setFlash('danger', 'Course creating failed, please recheck your input(s). '
                    . 'If you assure that the inputs are valid, please contact database administrator.');
            }
        }
        return $this->render('course', [
            'model' => $model,
        ]);
    }

    public function actionReport()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }

        return $this->render('report', [
            'model' => $model,
        ]);
    }

    public function actionWriteEmail()
    {
        $model = new EmailForm();

        $query = User::find()->select(['id', 'firstName', 'lastName', 'username', 'email'])->all();

        $users = ArrayHelper::map($query, 'email',
            function ($model, $defaultValue) {
                return $model['firstName'] . ' ' . $model['lastName'] . ', (' . $model['username'] . ') ' . $model['email'] . ', ID: ' . $model['id'];
            }
        );
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->uploadAttachments();
                $success = $model->createEmails();
                if ($success)
                    Yii::$app->session->setFlash('success', 'You have successfully sent the email.');
                else
                    Yii::$app->session->setFlash('danger', 'Email failed to send.');
                $model = new EmailForm();
            }
        }

        return $this->render('writeEmail', [
            'model' => $model,
            'users' => $users,
        ]);
    }
}


