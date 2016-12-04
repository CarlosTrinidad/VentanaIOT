<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Window */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="window-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'rain_sensor')->textInput() ?>

    <?= $form->field($model, 'light_sensor')->textInput() ?>

    <?= $form->field($model, 'voice_sensor')->textInput() ?>

    <?= $form->field($model, 'datetime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
