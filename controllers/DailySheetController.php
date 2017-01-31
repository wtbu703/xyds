<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/31
 * Time: 16:59
 */
namespace app\controllers;

use yii;
use yii\base\Controller;
use app\common\Common;
use app\models\ServiceSite;
use app\models\ServiceSiteInfo;
use yii\data\Pagination;
use app\models\Dictitem;
use yii\db\Query;
use app\models\ServiceSiteDealTable;
use app\models\Category;
use app\models\DailySheet;

/**
 * Class DailySheetController
 * @package app\controllers
 */
class DailySheetController extends Controller{

	/**
	 * @return string
	 */
	public function actionIndex(){

		return $this->render('index');
	}
}