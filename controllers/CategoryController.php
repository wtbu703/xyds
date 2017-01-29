<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/29
 * Time: 19:19
 */
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Category;
use app\models\CategoryFull;
use yii\helpers\Json;
use yii\data\Pagination;
use app\common\Common;

class CategoryController extends Controller{

	public function actionIndex(){
		return $this->render('index');
	}

	public function actionAdd(){
		return $this->render('add');
	}
}