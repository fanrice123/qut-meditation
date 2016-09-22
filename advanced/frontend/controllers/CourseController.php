<?php

namespace frontend\Controllers;

class CourseController extends \yii\web\Controller
{
    public function actionEnroll($id, $date) {

        if (Yii::$app->user->isGuest) {
            $this->redirect('/site/login');
        }

        $student = new Student();
        $student->studentID = Yii::$app->user->identity->id;
        $student->courseID = Yii::$id;
        if ($student->save()) {
            Yii::$app->session->setFlash('success', 'You have successfully enrolled the class starting on '.$date);
        }
        else {
            Yii::$app->session->setFlash('warning', 'Sorry, you have already enrolled the class');
        }
        $this->redirect('/site/course');

    }

}
