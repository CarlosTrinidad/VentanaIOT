<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Alarmas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alarmas-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'dia')->textInput() ?> -->
    <?= $form->field($model, 'dia')->widget(DateRangePicker::classname(),[
    	    'useWithAddon'=>false,
    	    'convertFormat'=>true,
		    'pluginOptions'=>[
		        'locale'=>['format' => 'Y-m-d'],
		        'singleDatePicker'=>true,
		        'showDropdowns'=>true
		    ]

    	]);
	 ?>

    <!-- <?= $form->field($model, 'hora')->textInput() ?> -->

   	<?= $form->field($model, 'hora')->widget(TimePicker::classname(), [
                'pluginOptions' => [
                    'showMeridian' => false,
                    'defaultTime' => 'current'
    ]]) ?>
     <?= $form->field($model, 'estado_ventana')->dropDownList(['0' => 'Cerrar','1' => 'Abrir']) ?>
     <?= $form->field($model, 'estado_cortina')->dropDownList(['0' => 'Cerrar','1' => 'Abrir']) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
