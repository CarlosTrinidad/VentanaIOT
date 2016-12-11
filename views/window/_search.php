<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WindowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="window-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'status_ventana') ?>
    <?= $form->field($model, 'status_cortina') ?>

    <?= $form->field($model, 'rain_sensor') ?>

    <?= $form->field($model, 'light_sensor') ?>

    <?= $form->field($model, 'voice_sensor') ?>

    <?php // echo $form->field($model, 'datetime') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
