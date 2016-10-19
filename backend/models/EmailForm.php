<?php

namespace backend\models;

use kartik\base\Module;
use Yii;
use yii\base\Model;
use yii\validators\EmailValidator;
use backend\models\Email;
use yii\web\UploadedFile;

/**
 * This is the form class for model email.
 *
 * @property string $title
 * @property string $sender
 * @property string $receivers
 * @property string $time
 * @property UploadedFile|string attachment
 * @property string|bool newFileName
 */
class EmailForm extends Model
{
    public $title, $sender, $receivers, $time, $content;

    public $attachment, $newFileName;

    public function __construct(array $config = [])
    {
        $this->newFileName = false;
        $user = Yii::$app->user->identity;
        $this->sender = $user->lastName.'.'.$user->firstName.'@omedi.org.au';
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'sender', 'receivers'], 'required'],
            [['receivers'], 'emailsValidation'],
            [['time', 'content'], 'safe'],
            [['title', 'sender'], 'string', 'max' => 255],
            [['attachment'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emailID' => 'Email ID',
            'title' => 'Subject',
            'sender' => 'Sender',
            'receivers' => 'To',
            'time' => 'Time',
            'content' => 'Content',
            'attachment' => 'Attachments',
        ];
    }

    public function emailsValidation($attribute, $params)
    {
        $validator = new EmailValidator();
        foreach ($this->receivers as $index => $email) {
            if (!$validator->validate($email))
                $this->addError('receivers', 'receiver \''.$email.'\' is an invalid email and it has been deleted. Please try again.');
        }
    }

    /**
     * @return bool|string if save file successfully then return file name otherwise return false
     */
    public function upload()
    {
        if (!empty($this->attachment)) {
            $newFilePath = 'uploads/' . Yii::$app->security->generateRandomString() . '.' . $this->attachment->extension;
            return $this->attachment->saveAs($this->newFileName) ? $newFilePath : null;
        }
    }

    public function createEmails($filePath = null)
    {
        $email = new Email();
        $email->title = $this->title;
        $email->sender = $this->sender;
        $email->receiver = implode(' ', $this->receivers);
        $email->content = $this->content;

        $email->save();

        $message = Yii::$app->mailer->compose()
            ->setFrom($this->sender)
            ->setTo($this->receivers)
            ->setSubject($this->title)
            ->setTextBody($this->content);

        if ($filePath)
            $message->attach($this->newFileName);

        return $message->send();
    }
}
