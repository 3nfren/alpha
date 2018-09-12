<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Proyectos */

$this->title = $model->idProyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proyectos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idProyecto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idProyecto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idProyecto',
            'NombreProyecto',
            'Activo',
        ],
    ]) ?>

</div>
