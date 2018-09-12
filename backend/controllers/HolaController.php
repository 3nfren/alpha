<?php
namespace backend\controllers;
use Yii;

class HolaController extends Controller {

	public function actionIndex(){
		$twitter = "@codigofacilito";
		$this->render("index",array("twitter"=>$twitter));
	}
}