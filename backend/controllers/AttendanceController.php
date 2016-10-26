<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use common\models\Course;
use yii\web\UploadedFile;
use backend\models\AttendanceForm;
use backend\models\Attendance;
use backend\models\AttendanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;

/**
 * AttendanceController implements the CRUD actions for Attendance model.
 */
class AttendanceController extends Controller
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
                        'actions' => ['index', 'update', 'view', 'create', '_form', '_search', 'pdf', 'load-days'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Attendance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AttendanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Attendance model.
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
     * Creates a new Attendance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AttendanceForm();

        $data = Course::find()->all();
        $courses = ArrayHelper::map($data, 'courseID',
            function ($model, $defaultValue) {
                return $model['courseID']. ' (from '.$model['start']. ' to '.$model['end'].', '.$model['duration'].' days)';
            }
        );

        $duration = $data;


        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d');
            $model->file = UploadedFile::getInstance($model, 'file');
            if (is_null($model->file))
                return '';
            if ($model->validate()) {
                // form inputs are valid, do something here
                if ($model->saveData(true)) {
                    Yii::$app->session->setFlash('success', 'data successfully saved!');
                } else {
                    Yii::$app->session->setFlash('danger', 'data upload failed.');
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'courses' => $courses,
            'test' => $this->actionLoadDays(),
        ]);
    }

    /**
     * Updates an existing Attendance model.
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
     * Deletes an existing Attendance model.
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
     * Finds the Attendance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Attendance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attendance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPdf($id)
    {
        $path = Attendance::findOne($id)->file;
        return $this->render('pdf', ['file' => $path]);
    }

    public function actionLoadDays()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $courseID = end($_POST['depdrop_parents']);
            $duration = Course::findOne($courseID)->duration;
            $out = [];
            if ($courseID != null) {
                $selected = '';
                for ($i = 1; $i <= $duration; ++$i)
                    $out[] = ['id' => $i, 'name' => 'Day '.$i];
                $selected = 1;
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
            /*$list = (new Query())->select(['c.studentID', 'u.firstName', 'u.lastName'])->from('classtable c')->where(['c.courseID' => $courseID])->innerJoin('user u', 'u.id=c.studentID')->all();
            $selected = null;
            if ($courseID != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $student) {
                    $out[] = ['id' => $student['studentID'], 'name' => $student['firstName'] . ' ' . $student['lastName']];
                    if ($i == 0) {
                        $selected = $student['studentID'];
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }*/
        }
        echo Json::encode(['output' => '', 'selected' => '']);
        /*$list = (new Query())->select(['c.studentID', 'u.firstName', 'u.lastName'])->from('classtable c')->innerJoin('user u', 'u.id=c.studentID')->all();
        //$list = Student::find()->asArray()->all();
        $selected = '';
        $out = [];
        foreach ($list as $i => $student) {
            $out[] = ['id' => $student['studentID'], 'name' => $student['firstName'] . ' ' . $student['lastName']];
            if ($i == 0) {
                $selected = $student['studentID'];
            }
        }
        return  Json::encode(['output' => $out, 'selected'=>$selected]);
        */
    }
}
