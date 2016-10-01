<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alarmas".
 *
 * @property integer $id
 * @property string $dia
 * @property string $hora
 * @property integer $estado_ventana
 * @property integer $estado_cortina
 */
class Alarmas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alarmas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dia', 'hora', 'estado_ventana', 'estado_cortina'], 'required'],
            [['dia', 'hora'], 'safe'],
            [['estado_ventana', 'estado_cortina'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dia' => Yii::t('app', 'Dia'),
            'hora' => Yii::t('app', 'Hora'),
            'estado_ventana' => Yii::t('app', 'Estado Ventana'),
            'estado_cortina' => Yii::t('app', 'Estado Cortina'),
        ];
    }
}
