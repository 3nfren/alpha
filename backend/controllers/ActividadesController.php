<?php

namespace backend\controllers;

use Yii;
use backend\models\Actividades;
use backend\models\search\ActividadesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ActividadesController implements the CRUD actions for Actividades model.
 */
class ActividadesController extends Controller
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
                        'actions' => ['index','view','create','delete','update','create-con-proyecto','update-con-proyecto','delete-con-proyecto'],
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
     * Lists all Actividades models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActividadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Actividades model.
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

    /**
     * Creates a new Actividades model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Actividades();
        $bandera = true;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'bandera' => $bandera,
        ]);
    }

    public function actionCreateConProyecto($idProyecto){
        $model = new Actividades();
        $model->idProyecto = $idProyecto;
        $bandera = false;

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['/proyectos/update','id'=>$idProyecto]);
        } else {
            return $this->render('create',['model'=>$model,'bandera'=>$bandera,]);
        }
    }

    public function actionUpdateConProyecto($id){
        $model = $this->findModel($id);
        $bandera = false;

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['/proyectos/update','id'=>$model->idProyecto]);
        } else {
            return $this->render('update',['model'=>$model,'bandera'=>$bandera,]);
        }
    }

    /**
     * Updates an existing Actividades model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $bandera = true;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'bandera' => $bandera,
        ]);
    }

    /**
     * Deletes an existing Actividades model.
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

     public function actionDeleteConProyecto($id)
    {
        $model = $this->findModel($id);
        $idProyecto = $model->idProyecto;
        $model->delete();
        return $this->redirect(['proyectos/update','id'=>$idProyecto]);
    }

    /**
     * Finds the Actividades model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Actividades the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Actividades::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
