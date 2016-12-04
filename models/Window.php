<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "window".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $rain_sensor
 * @property integer $light_sensor
 * @property integer $voice_sensor
 * @property string $datetime
 */
class Window extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'window';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'rain_sensor', 'light_sensor', 'voice_sensor', 'datetime'], 'required'],
            [['status', 'rain_sensor', 'light_sensor', 'voice_sensor'], 'integer'],
            [['datetime'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'rain_sensor' => Yii::t('app', 'Rain Sensor'),
            'light_sensor' => Yii::t('app', 'Light Sensor'),
            'voice_sensor' => Yii::t('app', 'Voice Sensor'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }
}
