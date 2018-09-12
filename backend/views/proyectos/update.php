<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Proyectos */

$this->title = 'Update Proyectos: ' . $model->idProyecto;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idProyecto, 'url' => ['view', 'id' => $model->idProyecto]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="proyectos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
