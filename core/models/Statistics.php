<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statistics".
 *
 * @property integer $id
 * @property string $sessions
 * @property string $date_log
 * @property string $sources
 * @property string $ip
 * @property string $address
 * @property string $opera
 * @property string $browser
 * @property string $date_contact
 * @property string $full_name
 * @property string $email
 * @property string $phone
 * @property string $content
 */
class Statistics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statistics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_log', 'date_contact'], 'safe'],
            [['content'], 'string'],
            [['sessions', 'sources', 'ip', 'address', 'opera', 'browser', 'full_name', 'email', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sessions' => 'Sessions',
            'date_log' => 'Thời gian',
            'sources' => 'Nguồn',
            'ip' => 'IP',
            'address' => 'Tỉnh/Thành phố',
            'opera' => 'Hệ điều hành',
            'browser' => 'Trình duyệt',
            'date_contact' => 'Ngày liên hệ',
            'full_name' => 'Họ và tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'content' => 'Nội dung',
        ];
    }

    /**
     * @inheritdoc
     * @return StatisticQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatisticQuery(get_called_class());
    }
}
