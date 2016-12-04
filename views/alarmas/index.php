<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AlarmasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$action = ['1' => 'Cerrar','0' => 'Abrir'];
$this->title = Yii::t('app', 'Alarmas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarmas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Alarmas'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Activar modo automatico'), ['mode?id=1'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'dia_hora',
            // 'listo',
            [
             'attribute' => 'estado_ventana',
             'value' => function ($model) {
                    $estado_full = array(  '1' => 'Cerrar',
                    '0' => 'Abrir');
                    $temp = ($model->estado_ventana);
                    $valor = ArrayHelper::getValue($estado_full, $temp);
                    return $valor;
                },
             ],            [
             'attribute' => 'estado_cortina',
             'value' => function ($model) {
                    $estado_full = array(  '1' => 'Cerrar',
                    '0' => 'Abrir');
                    $temp = ($model->estado_cortina);
                    $valor = ArrayHelper::getValue($estado_full, $temp);
                    return $valor;
                },
             ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
