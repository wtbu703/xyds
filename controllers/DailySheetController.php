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

	/**
	 * @return string
	 */
	public function actionFindByAttri(){

		$date1 = Yii::$app->request->get('date1');
		$date2 = Yii::$app->request->get('date2');

		$para = [];
		$para['date1'] = $date1;
		$para['date2'] = $date2;

		$whereStr = '1=1';
		if($date1 != ''){
			$whereStr = $whereStr." and date >= '".$date1."%'";
		}
		if($date2 != ''){
			$whereStr = $whereStr." and date <= '".$date2."%'";
		}

		$dailySheets = DailySheet::find()
			->where($whereStr);

		$pages = new Pagination([
			'totalCount' =>$dailySheets->count(),
			'pageSize' => Common::PAGESIZE
		]);
		$models = $dailySheets
			->offset($pages->offset)
			->orderBy('date DESC')
			->limit($pages->limit)
			->all();

		//字典转化
		$dictItem = Dictitem::find()
			->where(['dictCode' => 'DICT_SHEET'])
			->all();

		foreach($models as $key=>$data) {
			foreach ($dictItem as $index => $value) {
				if ($data->state == $value->dictItemCode) {
					$models[$key]->state = $value->dictItemName;
				}
			}
		}

		return $this->render('listall',[
			'dailySheets' => $models,
			'para' => $para,
			'pages' => $pages
		]);
	}
}