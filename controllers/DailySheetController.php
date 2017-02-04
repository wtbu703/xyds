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
use app\models\CategoryFull;
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

	/**
	 * @return bool|string
	 */
	public function actionFindOne(){

		$id = Yii::$app->request->get('id');
		$action = Yii::$app->request->get('action');

		$dailySheet = DailySheet::findOne($id);

		//以下是现实对模型中的字典项进行转化
		$dictItem = Dictitem::find()
			->where(['dictCode' => 'DICT_SHEET'])
			->all();
		foreach($dictItem as $index => $value){
			if($dailySheet->state == $value->dictItemCode){
				$dailySheet->state = $value->dictItemName;
			}
		}
		//到此处截止
		//如果是详情页
		if($action == 'detail')
		{
			return $this->render('detail',[
				'dailySheet' => $dailySheet
			]);

		} elseif($action == 'update')//如果是修改页
		{
			return $this->render('update',[
				'dailySheet' => $dailySheet
			]);
		}else{
			return false;
		}
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteOne(){

		$id = Yii::$app->request->post('id');
		if(DailySheet::findOne($id)->delete()){
			return "success";
		}else{
			return false;
		}
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteMore(){

		$ids = Yii::$app->request->post("ids");
		$id_array = explode('-',$ids);

		foreach($id_array as $key => $data){
			DailySheet::findOne($data)->delete();
		}
		return 'success';
	}

	public function actionUploadExcel(){
		//TODO
	}

	public function actionSubmit(){
		//TODO
	}

	/**
	 * @return string
	 */
	public function actionGenerate(){

		$serviceSites = ServiceSite::find();
		//分页
		$pages = new Pagination([
			'totalCount' =>$serviceSites->count(),
			'pageSize' => Common::PAGESIZE
		]);
		$models = $serviceSites
			->offset($pages->offset)
			->limit($pages->limit)
			->all();

		//字典转化
		$dictItem = Dictitem::find()
			->where(['dictCode' => 'DICT_COUNTYTYPE'])
			->all();

		foreach($models as $key=>$data) {
			foreach ($dictItem as $index => $value) {
				if ($data->countyType == $value->dictItemCode) {
					$models[$key]->countyType = $value->dictItemName;
				}
			}
		}

		return $this->render('generate',[
			'serviceSites' => $models,
			'pages' => $pages
		]);
	}

	/**
	 * @return string
	 */
	public function actionShowDealTable(){

		$siteId = Yii::$app->request->get('id');
		//$date = date("Y-m-d");
		$date = "2017-01-31";
		$dealTable = ServiceSiteDealTable::find()
			->where('siteId = :siteId and date = :date and state = "0"',[
				":siteId" => $siteId,
				":date" => $date
			])
			->one();
		$categoryFulls = CategoryFull::find()->all();
		$buyCategorys = [];
		$buySums = [];
		$sellCategory = [];
		$sellSums = [];
		$buyOrderTotal = '';
		$sellOrderTotal = '';
		if (!empty($dealTable->buyGoodCategory)) {
			$buyCategorys = explode('-',$dealTable->buyGoodCategory);
			foreach($buyCategorys as $key => $value){
				foreach($categoryFulls as $index => $data){
					if($value == $data->buyCode){
						$buyCategorys[$key] = $data->categoryFullName;
					}
				}
			}
		}
		if (!empty($dealTable->buyMoneySum)) {
			$buySums = explode('-',$dealTable->buyMoneySum);
		}
		if (!empty($dealTable->sellGoodCategory)) {
			$sellCategory = explode('-',$dealTable->sellGoodCategory);
			foreach($sellCategory as $key => $value){
				foreach($categoryFulls as $index => $data){
					if($value == $data->sellCode){
						$sellCategory[$key] = $data->categoryFullName;
					}
				}
			}
		}
		if (!empty($dealTable->sellMoneySum)) {
			$sellSums = explode('-',$dealTable->sellMoneySum);
		}
		if (!empty($dealTable->buyOrderTotal)) {
			$buyOrderTotal = $dealTable->buyOrderTotal;
		}
		if (!empty($dealTable->sellOrderTotal)) {
			$sellOrderTotal = $dealTable->sellOrderTotal;
		}
		return $this->render('show',[
			'buyCategorys' => $buyCategorys,
			'buySums' => $buySums,
			'buyOrderTotal' => $buyOrderTotal,
			'sellCategory' => $sellCategory,
			'sellSums' => $sellSums,
			'sellOrderTotal' => $sellOrderTotal
		]);
	}

	public function actionSaveOne(){
		//TODO
	}
}