<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use miloschuman\highcharts\Highstock;
use miloschuman\highcharts\SeriesDataHelper;
use app\models\Window;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WindowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Windows');
$this->params['breadcrumbs'][] = $this->title;


$window_data = Window::find()->orderBy('datetime')->all();

$dataProvider2 = new ArrayDataProvider([
    'allModels' => $window_data,
    'pagination' => [
        'pageSize' => 50000,
    ],

    ]);


use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;



?>
<div class="window-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <p>
    <?= 
        Highstock::widget([
                'options' => [
                        'title' => [
                            'text' => 'Actividad reciente:',
                        ],
                        'xAxis' => [
                            'tickPixelInterval' => 150,
                        ],
                    'series' => [
                        [
                            'type' => 'areaspline',
                            'color' => '#FF879D',
                            'turboThreshold' => 500,
                            'cropThreshold' => 10,
                            'allowPointSelect' => true,
                            'marker' => [
                                'symbol' => 'square',
                                        ],
                            'fillOpacity' => 0.55,
                            'threshold' => null,
                            'tooltip' => [
                                'shared' => true,
                                'crosshairs' => true,
                                'valueDecimals' => 10 ],
                            'name' => 'Luz',
                            'animation' => [
                            'duration' => 1000
                            ],
                            'tickWidth' => 1,
                            'data' => new SeriesDataHelper($dataProvider2, ['datetime:datetime','light_sensor:int']),
                        ],
                        [
                            'type' => 'areaspline',
                            'color' => '#00ABE7',
                            'turboThreshold' => 500,
                            'cropThreshold' => 10,
                            'allowPointSelect' => true,
                            'marker' => ['symbol' => 'diamond'
                                        ],
                            'fillOpacity' => 0.35,
                            'threshold' => null,
                            'tooltip' => [
                                'shared' => true,
                                'crosshairs' => true,
                                'valueDecimals' => 10 ],
                            'name' => 'Luvia',
                            'animation' => [
                            'duration' => 1000
                            ],
                            'tickWidth' => 1,
                            'data' => new SeriesDataHelper($dataProvider2, ['datetime:datetime','rain_sensor:int']),
                        ],                           
                        
                    ]
                ]
            ]);
     ?>
     </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'datetime',
            'status',
            'rain_sensor',
            'light_sensor',
            'voice_sensor',

            ['class' => 'yii\grid\ActionColumn',
                         'template' =>'{view} ',
                        ],
        ],
    ]); ?>
</div>
