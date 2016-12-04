<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "window_mode".
 *
 * @property integer $id
 * @property integer $automatico
 */
class WindowMode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'window_mode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['automatico'], 'required'],
            [['automatico'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'automatico' => Yii::t('app', 'Automatico'),
        ];
    }
}
