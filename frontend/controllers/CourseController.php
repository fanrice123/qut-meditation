<?php

namespace frontend\Controllers;

class CourseController extends \yii\web\Controller
{
    public function actionEnroll($id, $date) {

        if (Yii::$app->user->isGuest) {
            return $this->redirect('/site/login');
        }

        $student = new Student();
        $student->studentID = Yii::$app->user->identity->id;
        $student->courseID = $id;

        if ($student->save()) {
            Yii::$app->session->setFlash('success', 'You have successfully enrolled the class starting on '.$date);
        }
        else {
            Yii::$app->session->setFlash('warning', 'Sorry, you have already enrolled the class');
        }
        return $this->redirect('site/course');

    }

}
