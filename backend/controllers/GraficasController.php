<?php

namespace backend\controllers;

use yii\web\Controller;
use Yii;
use backend\models\Graficas;
use yii\filters\AccessControl;

/**
 * Description of GraficasController
 *
 * @author marcos
 */
class GraficasController extends Controller {

	 public function behaviors()
    {
        return [
            'acces'=>[
                'class' => AccessControl::className(),
                'rules' =>[
                    [
                        'actions' => ['index','view','create','delete','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
	

    const NUM_DIAS = 15;

    public function actionIndex() {
        $fechas = array();
        for ($i = 0; $i < self::NUM_DIAS; $i++)
            $fechas[$i] = date("d-m-Y", strtotime((self::NUM_DIAS - $i) . " days ago"));
        $grafica = new Graficas();
        $datos = $grafica->obtenDatos(self::NUM_DIAS, date('Y-m-d'), Yii::$app->user->id);
        return $this->render('tiempos', ['fechas' => $fechas, 'series' => $datos]);
    }
}
