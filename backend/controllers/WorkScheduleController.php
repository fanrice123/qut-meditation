<?php

namespace backend\controllers;

use backend\models\VolunteerIDForm;
use Yii;
use common\models\WorkSchedule;
use common\models\WorkScheduleSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use backend\models\CourseIDForm;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/**
 * WorkScheduleController implements the CRUD actions for WorkSchedule model.
 */
class WorkScheduleController extends Controller
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
     * Lists all WorkSchedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WorkSchedule model.
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
     * @var $schedules WorkSchedule[]
     */
    private $schedules;

    /**
     * @var $volunteer VolunteerIDForm[]
     */
    private $volunteer;

    /**
     * Creates a new WorkSchedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($courseID = '')
    {
        $this->schedules = [new WorkSchedule];
        $this->volunteer = new VolunteerIDForm;
        $modelCourseID = new CourseIDForm();
        $isValid = true;
        $log = $_POST;
        $cter = 0;

        if ($modelCourseID->load(Yii::$app->request->post())) {
            if ($this->volunteer->load(Yii::$app->request->post())) {
                foreach ($_POST['WorkSchedule'] as $index => $schedule) {
                    $this->schedules[$index] = new WorkSchedule();
                    $this->schedules[$index]->start = $schedule['start'];
                    $this->schedules[$index]->studentID = $this->volunteer->studentID;
                    $this->schedules[$index]->courseID = $modelCourseID->courseID;
                    $this->schedules[$index]->end = $schedule['end'];
                    $this->schedules[$index]->note = $schedule['note'];
                }
                if($modelCourseID->validate() && Model::validateMultiple($this->schedules)) {
                        $flag = true;
                        $log = $this->schedules;
                        $transaction = Yii::$app->db->beginTransaction();
                        try {
                            foreach($this->schedules as $index => $schedule) {
                                $flag = $flag && $schedule->save();
                            }
                            if ($flag) {
                                $transaction->commit();
                                Yii::$app->session->setFlash('success', 'Save.');

                            } else {
                                Yii::$app->session->setFlash('danger', 'error.');
                                $transaction->rollBack();
                            }

                        } catch (Exception $e) {
                            Yii::$app->session->setFlash('danger', 'GG');
                            $transaction->rollBack();
                        }
                }
            }
        }

        $data = (new Query())->select(['c.courseID', 'c.start', 'c.duration', 'c.end'])->from('course c')
            ->andWhere('CURDATE() <  DATE(c.start)')
            ->orderBy('c.start DESC')->all();
        $courses = ArrayHelper::map($data, 'courseID',
            function ($model, $defaultValue) {
                return $model['courseID']. ' (from '.$model['start']. ' to '.$model['end'].', '.$model['duration'].' days)';
            }
        );

        $volunteersAvail = (new Query())->select(['DISTINCT(cls.studentID)', 'u.username', 'u.firstName', 'u.lastName', 'cls.courseID', 'c.start', 'c.duration', 'c.end'])->from('volunteer cls')
            ->innerJoin('course c', 'cls.courseID=c.courseID')
            ->innerJoin('user u', 'u.id=cls.studentID')
            //->where('CURDATE() <  DATE(c.start)')
            ->orderBy('u.firstName DESC')->all();

        $volunteersAvailable = ArrayHelper::map($volunteersAvail, 'studentID',
            function ($model, $defaultValue) {
                return $model['firstName'] . ' ' . $model['lastName'] . ', (' . $model['username'] . '), ID: ' . $model['studentID'];
            }
        );

        return $this->render('create', [
            'modelCourseID' => $modelCourseID,
            'modelsSchedule' => $this->schedules,
            'volunteer' => $this->volunteer,
            'courses' => $courses,
            'courseID' => $courseID,
            'volunteersAvailable' => $volunteersAvailable,
            'log' => $log,
            'cter' => $cter,
        ]);

    }

    /**
     * Updates an existing WorkSchedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing WorkSchedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WorkSchedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WorkSchedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WorkSchedule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
