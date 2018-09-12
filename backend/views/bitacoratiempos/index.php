<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\BitacoratiemposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bitacoratiempos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bitacoratiempos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Bitacoratiempos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idBitacoraTiempo',
            'Fecha',
            'HoraInicio',
            'HoraFinal',
            //'Interrupcion',
            //'Total',
            //'ActividadNoPlaneada',
            //'idActividadePlaneada',
            //'idProyecto',
            //'Artefacto',
            //'idUsuario',
            ['class' => 'yii\grid\ActionColumn',
             'template' => '{view}{update}{delete}{update-con-fecha}',
                             'buttons' => [
                                'update-con-fecha' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-asterisk"></span>', $url );
                                }   ],
             'urlCreator' => function($action,$model,$key,$index){
                                if($action === 'update-con-fecha'){
                                    $url = Url::to(['bitacoratiempos/update-con-fecha','id'=> $model->idBitacoraTiempo]);
                                    return $url;
                                } else if($action == 'view'){
                                    $url = Url::to(['bitacoratiempos/view','id'=> $model->idBitacoraTiempo]);
                                    return $url;

                                } else if($action == 'delete'){
                                    $url = Url::to(['bitacoratiempos/delete','id'=> $model->idBitacoraTiempo]);
                                    return $url;

                                } else if($action == 'update'){
                                    $url = Url::to(['bitacoratiempos/update','id'=> $model->idBitacoraTiempo]);
                                    return $url;

                                }
                            }                   
            ]
        ],
    ]); ?>
</div>
