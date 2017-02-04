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
use yii\data\Pagination;
use app\models\Dictitem;
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
	 * 查看一个日报表
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
	 * 单个删除
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
	 * 多选删除
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
	 * 打开生成日报表页面
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
	 * 查看一个站点的交易信息
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

	/**
	 * 多选站点生成日报表
	 * @return bool|string
	 */
	public function actionSaveOne(){

		$ids = Yii::$app->request->post('ids');
		$date = Yii::$app->request->post('date');
		$ids_array = explode('-',$ids);

		$dealIds = '';
		$codes = '';
		$names = '';
		$countyTypes = '';

		$buyGoodCategorys = '';
		$buyMoneySums = '';
		$buyOrderTotals = '';
		$sellGoodCategorys = '';
		$sellMoneySums = '';
		$sellOrderTotals = '';
		foreach($ids_array as $key => $value){

			$serviceSite = ServiceSite::findOne($value);
			$codes = $codes.$serviceSite->code.'-';
			$names = $names.$serviceSite->name.'-';
			$countyTypes = $countyTypes.$serviceSite->countyType.'-';

			$dealTable = ServiceSiteDealTable::find()
				->where('siteId = :siteId and date = :date and state = "0"',[
					":siteId" => $value,
					":date" => $date
				])
				->one();
			$dealIds = $dealIds.$dealTable->id.'-';
			$buyGoodCategorys = $buyGoodCategorys.$dealTable->buyGoodCategory.';';
			$buyMoneySums = $buyMoneySums.$dealTable->buyMoneySum.';';
			$sellGoodCategorys = $sellGoodCategorys.$dealTable->sellGoodCategory.';';
			$sellMoneySums = $sellMoneySums.$dealTable->sellMoneySum.';';
			$buyOrderTotals = $buyOrderTotals.$dealTable->buyOrderTotal.'-';
			$sellOrderTotals = $sellOrderTotals.$dealTable->sellOrderTotal.'-';

		}

		$dailySheet = new DailySheet();
		$dailySheet->id = Common::create40ID();
		$dailySheet->siteId = $ids;
		$dailySheet->dealId = $dealIds;
		$dailySheet->code = $codes;
		$dailySheet->name = $names;
		$dailySheet->countyType = $countyTypes;
		$dailySheet->buyGoodCategory = $buyGoodCategorys;
		$dailySheet->buyMoneySum = $buyMoneySums;
		$dailySheet->buyOrderTotal = $buyOrderTotals;
		$dailySheet->sellGoodCategory = $sellGoodCategorys;
		$dailySheet->sellMoneySum = $sellMoneySums;
		$dailySheet->sellOrderTotal = $sellOrderTotals;
		$dailySheet->date = $date;
		$dailySheet->state = '0';
		if($dailySheet->save()){
			return 'success';
		}else{
			return false;
		}
	}
}