<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Bitacoratiempos */


foreach ($model as $models) {
//$this->title = $models->idBitacoraTiempo;
$this->title = $models['idBitacoraTiempo'];    
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bitacoratiempos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<br>
<div class="bitacoratiempos-viewFechas">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $models['idBitacoraTiempo']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $models['idBitacoraTiempo']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <?= DetailView::widget([
        'model' => $models,
        'attributes' => [
            'idBitacoraTiempo',
            'Fecha',
            'HoraInicio',
            'HoraFinal',
            'Interrupcion',
            'Total',
            'ActividadNoPlaneada',
            'idActividadePlaneada',
            'idProyecto',
            'Artefacto',
            'idUsuario',
        ],
    ])?> 
</div>
<?php } ?>
