<?php

namespace backend\controllers;

use common\models\Course;
use common\models\Student;
use common\models\WorkSchedule;
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
use yii\web\UploadedFile;
use yii2fullcalendar\models\Event;
use backend\models\AttendanceForm;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;

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
                        'actions' => ['logout', 'index', 'course', 'report', 'write-email', 'attendance', 'load-days', 'lists'],
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
     * @var Event;
     */
    private $t;

    /**
     * @var Event[[]]
     */
    private $schedules;

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->schedules = [[]];
        $events = [];

        $courses = Course::find()->all();
        foreach ($courses as $index => $course) {
            $event = new Event();
            $event->start = $course->start;
            $end = \DateTime::createFromFormat('Y-m-d', $course->end);
            $end->modify('+1 day');
            $event->end = $end->format('Y-m-d');
            $event->title = 'CourseID: '.$course['courseID']. ',duration: '.$course['duration'].' days';
            $event->color = '#A0A0A0';
            $events[] = $event;

        }

        $schedules = WorkSchedule::find()->all();
        foreach ($schedules as $index => $schedule) {
            $courseID = $schedule->courseID;
            $this->schedules[$courseID][$index] = new Event();
            //$this->schedules[$courseID][$index]->id = $schedule->id;
            $this->schedules[$courseID][$index]->start = $schedule->start;
            $this->schedules[$courseID][$index]->end = $schedule->end;
            $this->schedules[$courseID][$index]->title = 's.'.$schedule->studentID. ', '. $courseID;
        }
        foreach($this->schedules as $indices => $values) {
            $rand = dechex(rand(0x000000, 0xFFFFFF));
            $colour = '#'.$rand;
            foreach ($values as $key => $schedule) {
                $schedule->color = $colour;
                $events[] = $schedule;
            }
        }

        return $this->render('index', [
            'events' => $events,
        ]);
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
        $dataProvider = new ActiveDataProvider([
            'query' => Course::find()->where('DATE(start) > CURDATE()')->orderBy('start'),
            'sort' => false,
            'pagination' => ['pageSize' => 10]
        ]);

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
            'dataProvider' => $dataProvider
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
            $success = false;
            // form inputs are valid, do something here
            if ($model->validate()) {
                $model->attachment = UploadedFile::getInstance($model, 'attachment');
                if (!is_null($model->attachment)) {
                    $filePath = $model->upload();
                    $success = $model->createEmails($filePath);
                } else {
                    $success = $model->createEmails();
                }
                if ($success)
                    Yii::$app->session->setFlash('success', 'You have successfully sent the email.');
                else
                    Yii::$app->session->setFlash('danger', 'Email failed to send.');
            }
        }

        return $this->render('writeEmail', [
            'model' => $model,
            'users' => $users,
            'g' => $model->receivers,
        ]);
    }
}


