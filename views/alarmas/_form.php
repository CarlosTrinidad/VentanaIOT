<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Alarmas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alarmas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dia_hora')->widget(DateRangePicker::classname(),[
            'useWithAddon'=>false,
            'convertFormat'=>true,
            'pluginOptions'=>[
                'timePicker'=>true,
                'timePicker24Hour' => true,
                'locale'=>['format' => 'Y-m-d H:i'],
                'singleDatePicker'=>true,
                'showDropdowns'=>true
            ]

        ]);
     ?>

    <!-- <?= $form->field($model, 'listo')->textInput() ?> -->
    <?= $form->field($model, 'estado_ventana')->dropDownList(['1' => 'Cerrar','0' => 'Abrir']) ?>
    <?= $form->field($model, 'estado_cortina')->dropDownList(['1' => 'Cerrar','0' => 'Abrir']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
