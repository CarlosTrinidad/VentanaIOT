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
            [['status_ventana', 'status_cortina', 'rain_sensor', 'light_sensor', 'voice_sensor', 'datetime'], 'required'],
            [['status_ventana', 'status_cortina', 'rain_sensor', 'light_sensor', 'voice_sensor'], 'integer'],
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
            'status_cortina' => Yii::t('app', 'Status Cortina'),
            'status_ventana' => Yii::t('app', 'Status Ventana'),
            'rain_sensor' => Yii::t('app', 'Rain Sensor'),
            'light_sensor' => Yii::t('app', 'Light Sensor'),
            'voice_sensor' => Yii::t('app', 'Voice Sensor'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }
}
