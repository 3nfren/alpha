<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model backend\models\Proyectos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proyectos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NombreProyecto')->textInput(['maxlength' => true]) ?>

    <?php
    	if(!$model->isNewRecord){
    		echo $form->field($model, 'Activo')->checkbox();
 
    ?>
    
    <h2>Actividades</h2>
        <?=
        \yii\grid\GridView::widget([
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => $model->getActividades(),
                'pagination' => false
                ]),
                'columns' => [
                	
                    'NombreActividad',
                    	[
                    		'class' => '\yii\grid\ActionColumn',
                    		 'controller' => 'actividades',
                    		 'header'=> Html::a('<i class="glyphicon glyphicon-plus"></i>&nbsp;Agregar nueva', ['actividades/create-con-proyecto', 'idProyecto'=>$model->idProyecto]),
                    		 'template' => '{update-con-proyecto}{delete}',
                    		 'buttons' => [
                        		'update-con-proyecto' => function ($url, $model) {
                            		return Html::a('<span class="glyphicon  glyphicon-pencil"></span>', $url );
                            	}
                            ],
                            'urlCreator' => function($action,$model,$key,$index){
                            	if($action === 'update-con-proyecto'){
                            		$url = Url::to(['actividades/update-con-proyecto','id'=> $model->idActividad]);
                            		return $url;
                            	} else if($action == 'delete'){
                            		$url = Url::to(['actividades/delete-con-proyecto','id'=> $model->idActividad]);
                            		return $url;

                            	}
                            }

                    	],
                    ]
            ]);
        ?>
    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton('update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
