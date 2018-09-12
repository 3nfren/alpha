<?php

namespace backend\controllers;

use Yii;
use backend\models\Bitacoratiempos;
use backend\models\search\BitacoratiemposSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BitacoratiemposController implements the CRUD actions for Bitacoratiempos model.
 */
class BitacoratiemposController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'acces'=>[
                'class' => AccessControl::className(),
                'rules' =>[
                    [
                        'actions' => ['index','view','create','delete','update','search','update-con-fecha'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Bitacoratiempos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BitacoratiemposSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /*    
    public function actionSerch($HoraInicio,$HoraFinal){

    }
    */
    /**
     * Displays a single Bitacoratiempos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    
    public function actionView($id)
    {
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    
    public function actionUpdateConFecha($id)
    {    $var = $this->findModel($id);
        $bitacora = new Bitacoratiempos();

            $model = $bitacora->difTiempos($var->HoraInicio,$var->HoraFinal);
         if($model != null)
            return $this->render('viewFechas',['model' => $model]);
        else
             return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
  
    }


    public function actionUsuarios(){
      $usuarios=new Usuarios();
                            //Sacar todos los registros de la tabla
      $getUsuarios=$usuarios->getUsuarios();
      
     $this->render('usuarios',array(
                    "usuarios"=>$getUsuarios
                   ));
}


    /**
     * Creates a new Bitacoratiempos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bitacoratiempos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idBitacoraTiempo]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Bitacoratiempos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idBitacoraTiempo]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Bitacoratiempos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bitacoratiempos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bitacoratiempos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bitacoratiempos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
