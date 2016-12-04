<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WindowMode */

$this->title = Yii::t('app', 'Create Window Mode');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Window Modes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="window-mode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
