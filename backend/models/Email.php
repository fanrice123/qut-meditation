<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "email".
 *
 * @property integer $emailID
 * @property string $title
 * @property string $sender
 * @property string $receiver
 * @property string content
 * @property string attachments
 */
class Email extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'sender', 'receiver'], 'required'],
            [['receiver'], 'email'],
            [['time', 'content', 'attachments'], 'safe'],
            [['title', 'sender'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'time' => 'Time',
        ];
    }
}
