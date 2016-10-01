<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alarmas".
 *
 * @property integer $id
 * @property string $dia_hora
 * @property integer $listo
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
            [['dia_hora', 'estado_ventana', 'estado_cortina'], 'required'],
            [['dia_hora'], 'safe'],
            [['listo', 'estado_ventana', 'estado_cortina'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dia_hora' => Yii::t('app', 'Dia Hora'),
            'listo' => Yii::t('app', 'Listo'),
            'estado_ventana' => Yii::t('app', 'Estado Ventana'),
            'estado_cortina' => Yii::t('app', 'Estado Cortina'),
        ];
    }
}
