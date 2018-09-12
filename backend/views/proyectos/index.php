<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProyectosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyectos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Proyectos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idProyecto',
            'NombreProyecto',
            'Activo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
