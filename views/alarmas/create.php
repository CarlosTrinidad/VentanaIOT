<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Alarmas */

$this->title = Yii::t('app', 'Create Alarmas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Alarmas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarmas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
