<?php

namespace frontend\controllers;

use frontend\models\ChangeEmailForm;
use frontend\models\ChangePasswordForm;
use Yii;
use common\models\User;
use common\models\UserForm;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\Report;
use yii\db\Query;
use kartik\markdown\Markdown;
use common\models\Course;

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
            Yii::$app->session->setFlash('kv-detail-success', 'Enrolled successfully');
            // Multiple alerts can be set like below
            /*
            Yii::$app->session->setFlash('kv-detail-warning', 'A last warning for completing all data.');
            Yii::$app->session->setFlash('kv-detail-info', '<b>Note:</b> You can proceed by clicking <a href="#">this link</a>.');
            */
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


    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            // form inputs are valid, do something here
            Yii::$app->session->setFlash('success', 'Password successfully changed.');
            return $this->render('changePassword', ['model' => new ChangePasswordForm()]);
        }

        return $this->render('changePassword', [
            'model' => $model,
        ]);
    }

    public function actionChangeEmail()
    {
        $model = new ChangeEmailForm();
        $model->email = User::findOne(Yii::$app->user->id)->email;
        if ($model->load(Yii::$app->request->post()) && $model->changeEmail()) {
            // form inputs are valid, do something here
            Yii::$app->session->setFlash('success', 'Email successfully changed.');
            $model->email = User::findOne(Yii::$app->user->id)->email;
            $model->password = '';
            return $this->render('changeEmail', ['model' => $model]);
        }

        return $this->render('changeEmail', [
            'model' => $model,
        ]);
    }

    public function actionAllEnrollments()
    {
        /*
        *  SELECT cls.studentID, cls.courseID, c.start, c.duration, c.end
        *  FROM classtable cls
        *  WHERE studentID = Yii->$app->user->identity->id
        *  INNER JOIN course c
        *  ON cls.courseID = c.courseID;
        */
        $upcoming = (new Query())->select(['cls.courseID', 'c.start', 'c.duration', 'c.end'])->from('classtable cls')
            ->where(['studentID' => Yii::$app->user->identity->id])
            ->innerJoin('course c', 'cls.courseID=c.courseID')
            ->orderBy('c.start DESC');
        $dataProvider = new ActiveDataProvider([
            'query' => $upcoming,
            'pagination' => ['pageSize' => 10]
        ]);

        return $this->render('allEnrollments', ['dataProvider' => $dataProvider]);
    }

    public function actionUpcomingEnrollments()
    {
        /*
        *  SELECT cls.studentID, cls.courseID, c.start, c.duration, c.end
        *  FROM classtable cls
        *  WHERE studentID = Yii->$app->user->identity->id
        *  INNER JOIN course c
        *  ON cls.courseID = c.courseID AND c.start > 'today';
        */
        $upcoming = (new Query())->select(['cls.courseID', 'c.start', 'c.duration', 'c.end'])->from('classtable cls')
            ->where(['studentID' => Yii::$app->user->identity->id])
            ->innerJoin('course c', 'cls.courseID=c.courseID AND DATE(c.start) > \''.date('Y-m-d').'\'')
            ->orderBy('c.start');
        $dataProvider = new ActiveDataProvider([
            //'query' => Course::find()->where('DATE(start) > \''.date('Y-m-d').'\'')->orderBy('start'),
            'query' => $upcoming,
            'pagination' => ['pageSize' => 10]
        ]);

        return $this->render('upcomingEnrollments', ['dataProvider' => $dataProvider]);
    }

    public function actionEnrollmentHistory()
    {
        /*
         *  SELECT * FROM (
         *      SELECT cls.studentID, cls.courseID, c.start, c.end
         *      FROM classtable cls
         *      WHERE studentID = Yii->$app->user->identity->id
         *      INNER JOIN course c
         *      ON cls.courseID = c.courseID AND 'today' >= DATE(c.end);
         *  ) T
         *  WHERE 'today' >= DATE(t.end);
         */
        $upcoming = (new Query())->select(['cls.courseID', 'c.start', 'c.duration', 'c.end'])->from('classtable cls')
            ->where(['studentID' => Yii::$app->user->identity->id])
            ->innerJoin('course c', 'cls.courseID=c.courseID AND CURDATE()>=DATE(c.end)')
            ->orderBy('c.start');
        $dataProvider = new ActiveDataProvider([
            //'query' => Course::find()->where('DATE(start) > \''.date('Y-m-d').'\'')->orderBy('start'),
            'query' => $upcoming,
            'pagination' => ['pageSize' => 10]
        ]);

        return $this->render('enrollmentHistory', ['dataProvider' => $dataProvider]);
    }

    public function actionReport()
    {
        /*
         *  SELECT r.*, c.start, c.end, c.duration
         *  FROM report r
         *  WHERE studentID = Yii->$app->user->identity->id
         *  INNER JOIN course c
         *  ON r.courseID = c.courseID;
         */
        $data = (new Query())->select(['r.*', 'c.start', 'c.end', 'c.duration'])
            ->from('report r')
            ->where(['studentID' => Yii::$app->user->id])
            ->innerJoin('course c', 'r.courseID=c.courseID')
            ->all();

        $courses = array();
        foreach($data as $index => $properties) {
            if(empty($courses)) {
                $courses = [
                    [
                        'label' => 'Course ID : '.$properties['courseID'] . ' (from ' . $properties['start'] . ' to ' . $properties['end'] . ')',
                        'content' => Markdown::convert($properties['content'])
                    ]
                ];
            } else {
                $courses[] = [
                    'label' => 'Course ID : '.$properties['courseID'] . ' (from ' . $properties['start'] . ' to ' . $properties['end'] . ')',
                    'content' => Markdown::convert($properties['content'])
                ];
            }
        }


        return $this->render('report', ['courses' => $courses]);
    }

    public function actionNewReport($courseID = null)
    {
        $model = Report::create($courseID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Report saved.');
            $model = Report::create($courseID);
        }

        $data = (new Query())->select(['cls.courseID', 'c.start', 'c.duration', 'c.end'])->from('volunteer cls')
            ->innerJoin('course c', 'cls.courseID=c.courseID')
            ->where(['cls.studentID' => Yii::$app->user->identity->id])
            ->andWhere('CURDATE() BETWEEN  DATE(c.start) AND DATE(c.end)')
            ->orderBy('c.start DESC')->all();
        $courses = ArrayHelper::map($data, 'courseID',
            function ($model, $defaultValue) {
                return $model['courseID']. ' (from '.$model['start']. ' to '.$model['end'].', '.$model['duration'].' days)';
            }
        );

        return $this->render('newReport', [
            'model' => $model,
            'courses' => $courses,
            'courseID' => $courseID
        ]);
    }

    public function actionCurrentEnrollment()
    {

        /*
         *  SELECT cls.studentID, cls.courseID, c.start, c.duration, c.end
         *  FROM classtable cls
         *  WHERE studentID = Yii->$app->user->identity->id
         *  INNER JOIN course c
         *  ON cls.courseID = c.courseID AND c.start > 'today';
         */

        $current = (new Query())->select(['cls.courseID'])->from('classtable cls')
            ->innerJoin('course c', 'cls.courseID=c.courseID')
            ->where(['cls.studentID' => Yii::$app->user->identity->id])
            ->andWhere('CURDATE() BETWEEN  DATE(c.start) AND DATE(c.end)')
            ->one();
        $current = Course::findOne(['courseID' => $current['courseID']]);

        $classmates = (new Query())->select(['CONCAT(u.firstName, \' \', u.lastName) AS name'])->from('classtable cls')
            ->innerJoin('course c', 'cls.courseID=c.courseID')
            ->innerJoin('user u', 'u.id=cls.studentID')
            ->where('cls.studentID !=' . Yii::$app->user->identity->id)
            ->andWhere('CURDATE() BETWEEN  DATE(c.start) AND DATE(c.end)')
            ->all();

        $volunteers = (new Query())->select(['CONCAT(u.firstName, \' \', u.lastName) AS name'])->from('volunteer cls')
            ->innerJoin('course c', 'cls.courseID=c.courseID')
            ->innerJoin('user u', 'u.id=cls.studentID')
            ->andWhere('CURDATE() BETWEEN  DATE(c.start) AND DATE(c.end)')
            ->all();

        // convert retrieved tables into strings, which is the participants' name.
        $classmatesName = null;
        foreach ($classmates as $key => $name) {
            $classmatesName .= $name['name'].', ';
        }
        $classmatesName = rtrim($classmatesName, ', ');

        $volunteersName = null;
        foreach ($volunteers as $key => $name) {
            $volunteersName .= $name['name'].', ';
        }
        $volunteersName = rtrim($volunteersName, ', ');

        return $this->render('currentEnrollment', [
            'model' => $current,
            'classmates' => $classmatesName,
            'volunteers' => $volunteersName,
        ]);
    }
}
