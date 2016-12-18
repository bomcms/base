<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $body;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone'], 'required'],
            ['body', 'string'],
            ['email', 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Họ và tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            $mailFrom = Yii::$app->params['mailFrom'];
            $mailFromName = Yii::$app->params['mailFromName'];
            $mailSubject = $this->name . ' ' . Yii::$app->params['mailSubject'];
            $mailWebsite = Yii::$app->params['mailWebsite'];
            $mailBody = 'Bạn nhận được liên hệ từ website ' . $mailWebsite . '</br />'
                . '<p><strong>Họ và tên:</strong> ' . $this->name . '</p>'
                . '<p><strong>Số điện thoại:</strong> ' . $this->phone . '</p>'
                . '<p><strong>Email:</strong> ' . $this->email . '</p>'
                . '<p><strong>Nội dung:</strong> ' . $this->body . '</p>';
            try {
                Yii::$app->mailer->compose()
                    ->setTo($email)
                    ->setFrom([$mailFrom => $mailFromName])
                    ->setReplyTo([$this->email => $this->name])
                    ->setSubject($mailSubject)
                    ->setHtmlBody($mailBody)
                    ->send();
                return true;
            } catch (\Swift_SwiftException $e) {
                return $e->getMessage();
            }

        }
        return false;
    }
}
