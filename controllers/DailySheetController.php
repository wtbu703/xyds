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
use app\common\Phpexcel;

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
	 * 根据条件查询
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

		$codes = explode('-',$dailySheet->code);
		$names = explode('-',$dailySheet->name);
		$countyTypes = explode('-',$dailySheet->countyType);

		$buyGoodCategorys_array = explode(';',$dailySheet->buyGoodCategory);
		foreach($buyGoodCategorys_array as $key => $value){
			$buyGoodCategorys[$key] = explode('-',$value);
		}

		$buyMoneySums_array = explode(';',$dailySheet->buyMoneySum);
		foreach($buyMoneySums_array as $key => $value){
			$buyMoneySums[$key] = explode('-',$value);
		}

		$buyOrderTotals = explode('-',$dailySheet->buyOrderTotal);
		$sellGoodCategorys_array = explode(';',$dailySheet->sellGoodCategory);
		foreach($sellGoodCategorys_array as $key => $value){
			$sellGoodCategorys[$key] = explode('-',$value);
		}
		$sellMoneySums_array = explode(';',$dailySheet->sellMoneySum);
		foreach($sellMoneySums_array as $key => $value){
			$sellMoneySums[$key] = explode('-',$value);
		}
		$sellOrderTotals = explode('-',$dailySheet->sellOrderTotal);

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
				'codes' => $codes,
				'names' => $names,
				'countyTypes' => $countyTypes,
				'buyGoodCategorys' => $buyGoodCategorys,
				'buyMoneySums' => $buyMoneySums,
				'buyOrderTotals' => $buyOrderTotals,
				'sellGoodCategorys' => $sellGoodCategorys,
				'sellMoneySums' => $sellMoneySums,
				'sellOrderTotals' => $sellOrderTotals
			]);

		} elseif($action == 'update')//如果是修改页
		{
			return $this->render('update',[
				'id' => $id,
				'codes' => $codes,
				'names' => $names,
				'countyTypes' => $countyTypes,
				'buyGoodCategorys' => $buyGoodCategorys,
				'buyMoneySums' => $buyMoneySums,
				'buyOrderTotals' => $buyOrderTotals,
				'sellGoodCategorys' => $sellGoodCategorys,
				'sellMoneySums' => $sellMoneySums,
				'sellOrderTotals' => $sellOrderTotals
			]);
		}else{
			return false;
		}
	}

	/**
	 * 修改一个日报表
	 * @return bool|string
	 */
	public function actionUpdate(){

		$id = Yii::$app->request->post('id');
		$dailySheet = DailySheet::findOne($id);
		$dailySheet->code = Yii::$app->request->post('codes');
		$dailySheet->name = Yii::$app->request->post('names');
		$dailySheet->countyType = Yii::$app->request->post('countyTypes');
		$dailySheet->buyOrderTotal = Yii::$app->request->post('buyOrderTotals');
		$dailySheet->sellOrderTotal = Yii::$app->request->post('sellOrderTotals');
		if($dailySheet->save()){
			return 'success';
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

	/**
	 * 前往上传页面
	 * @return string
	 */
	public function actionUploadExcel(){
		return $this->render('excel');
	}

	/**
	 * 上传Excel
	 * @return string
	 */
	public function actionUpload(){

		if (Yii::$app->request->isPost) {

			$fileArg = Common::upload($_FILES,false,false);
			return $this->render('upload',[
				"fileArg" => $fileArg,
				"tag" => $fileArg['tag'],
			]);
		}
		return $this->render('upload',[
			"tag" => "empty",
			"fileArg" =>[
				"fileName" => "",     //保存到数据库的文件名称
				"fileSaveUrl" =>"",//上传文件保存的路径
				"tag" => "",//当为success表示上传成功，当为error时表示文件过大或是文件类型不对
			],
		]);
	}

	/**
	 * 根据ID把日报表转化成XML发送到指定接口
	 * @return string
	 */
	public function actionSubmit(){

		$id = Yii::$app->request->post('id');
		//$id = 'c494a44d3b00b4da7e8ba24b4bee41a5b48cde83';
		$dailySheet = DailySheet::findOne($id);
		$string = /** @lang text */
<<<XML
<?xml version='1.0' encoding='utf-8'?>
<items>
</items>
XML;
		$xml = simplexml_load_string($string);

		$codes = explode('-',$dailySheet->code);
		$names = explode('-',$dailySheet->name);
		$countyTypes = explode('-',$dailySheet->countyType);

		$buyGoodCategorys_array = explode(';',$dailySheet->buyGoodCategory);
		foreach($buyGoodCategorys_array as $key => $value){
			$buyGoodCategorys[$key] = explode('-',$value);
		}

		$buyMoneySums_array = explode(';',$dailySheet->buyMoneySum);
		foreach($buyMoneySums_array as $key => $value){
			$buyMoneySums[$key] = explode('-',$value);
		}

		$buyOrderTotals = explode('-',$dailySheet->buyOrderTotal);
		$sellGoodCategorys_array = explode(';',$dailySheet->sellGoodCategory);
		foreach($sellGoodCategorys_array as $key => $value){
			$sellGoodCategorys[$key] = explode('-',$value);
		}
		$sellMoneySums_array = explode(';',$dailySheet->sellMoneySum);
		foreach($sellMoneySums_array as $key => $value){
			$sellMoneySums[$key] = explode('-',$value);
		}
		$sellOrderTotals = explode('-',$dailySheet->sellOrderTotal);

		$serviceStation = $xml->addChild('serviceStation');
		$rptDate = $serviceStation->addChild('rptDate',$dailySheet->date);
		foreach($codes as $key => $value){
			$serviceStationReport = $serviceStation->addChild('serviceStationReport');
			$code = $serviceStationReport->addChild('code',$value);
			$name = $serviceStationReport->addChild('name',$names[$key]);
			$countyType = $serviceStationReport->addChild('countyType',$countyTypes[$key]);
			$buyOrder = $serviceStationReport->addChild('buyOrder',$buyOrderTotals[$key]);
			$saleOrder = $serviceStationReport->addChild('saleOrder',$sellOrderTotals[$key]);
			foreach($buyGoodCategorys[$key] as $index => $data){
				$serviceStationCommodity = $serviceStationReport->addChild('serviceStationCommodity');
				$commId = $serviceStationCommodity->addChild('commId',$data);
				$money = $serviceStationCommodity->addChild('money',$buyMoneySums[$key][$index]);
			}
			foreach($sellGoodCategorys[$key] as $index => $data){
				$serviceStationCommodity = $serviceStationReport->addChild('serviceStationCommodity');
				$commId = $serviceStationCommodity->addChild('commId',$data);
				$money = $serviceStationCommodity->addChild('money',$sellMoneySums[$key][$index]);
			}
		}
		//echo $xml->asXML();
		return 'success';

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
	/*public function actionShowDealTable(){

		$siteId = Yii::$app->request->get('id');
		$date = date("Y-m-d");//查看当天
		//$date = "2017-01-31";
		$dealTable = ServiceSiteDealTable::find()
			->where('siteId = :siteId and date = :date and state = "0"',[
				":siteId" => $siteId,
				":date" => $date//选择当天查询
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
	}*/

	/**
	 * 多选站点生成日报表
	 * @return bool|string
	 */
	public function actionSaveOne(){

		$ids = Yii::$app->request->post('ids');
		$date = Yii::$app->request->post('date');//接收时间
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
		foreach($ids_array as $key => $value) {

			$serviceSite = ServiceSite::findOne($value);
			if ($key == 0) {
				$codes = $codes . $serviceSite->code;
				$names = $names . $serviceSite->name;
				$countyTypes = $countyTypes . $serviceSite->countyType;
			} else {
				$codes = $codes . '-' . $serviceSite->code;
				$names = $names . '-' . $serviceSite->name;
				$countyTypes = $countyTypes . '-' . $serviceSite->countyType;
			}





			$dealTables = ServiceSiteDealTable::find()
				->where('siteId = :siteId and date = :date and state = "0"',[
					":siteId" => $value,
					":date" => $date//选择生成的时间
				])
				->all();
			foreach($dealTables as $index => $dealTable){
				$dealTable->state = '1';
				$dealTable->save();
				if($key == 0 && $index== 0){
					$dealIds = $dealIds.$dealTable->id;
					$buyGoodCategorys = $buyGoodCategorys.$dealTable->buyGoodCategory;
					$buyMoneySums = $buyMoneySums.$dealTable->buyMoneySum;
					$sellGoodCategorys = $sellGoodCategorys.$dealTable->sellGoodCategory;
					$sellMoneySums = $sellMoneySums.$dealTable->sellMoneySum;
					$buyOrderTotals = $buyOrderTotals.$dealTable->buyOrderTotal;
					$sellOrderTotals = $sellOrderTotals.$dealTable->sellOrderTotal;
				}else{
					$dealIds = $dealIds.'-'.$dealTable->id;
					$buyGoodCategorys = $buyGoodCategorys.';'.$dealTable->buyGoodCategory;
					$buyMoneySums = $buyMoneySums.';'.$dealTable->buyMoneySum;
					$sellGoodCategorys = $sellGoodCategorys.';'.$dealTable->sellGoodCategory;
					$sellMoneySums = $sellMoneySums.';'.$dealTable->sellMoneySum;
					$buyOrderTotals = $buyOrderTotals.'-'.$dealTable->buyOrderTotal;
					$sellOrderTotals = $sellOrderTotals.'-'.$dealTable->sellOrderTotal;
				}
			}

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

	/**
	 * 把上传的Excel转为记录
	 * @return string
	 */
	public function actionSaveExcel(){

		$date = Yii::$app->request->post('date');
		$attachUrls = Yii::$app->request->post('attachUrls');
		$attachNames = Yii::$app->request->post('attachNames');

		$dailySheet = new DailySheet();

		//使用PHPExcel读取上传的文件
		$phpExcel = new Phpexcel($dailySheet);
		$sheetData = $phpExcel->ReadExcel($attachUrls);
		//var_dump($sheetData);//调试
		//如果格式规范
		$codes = $sheetData[2]['B'];
		$names = $sheetData[2]['C'];
		$countyTypes = $sheetData[2]['D'];
		$buyOrderTotals = $sheetData[2]['G'];
		$sellOrderTotals = $sheetData[2]['J'];

		$buyGoodCategorys = $sheetData[2]['E'];
		$buyMoneySums = $sheetData[2]['F'];
		$sellGoodCategorys = $sheetData[2]['H'];
		$sellMoneySums = $sheetData[2]['I'];
		foreach($sheetData as $key => $value){
			if(is_null($value['E'])){
				break;//如果为空了提前结束
			}
			if($key>2){
				if(!is_null($value['A'])){
					$codes .= '-'.$value['B'];
					$names .= '-'.$value['C'];
					$countyTypes .= '-'.$value['D'];
					$buyOrderTotals .= '-'.$value['G'];
					$sellOrderTotals .= '-'.$value['J'];

					$buyGoodCategorys .= ';'.$value['E'];//不同的站点间商品类别用;分隔
					$buyMoneySums .= ';'.$value['F'];
					$sellGoodCategorys .= ';'.$value['H'];
					$sellMoneySums .= ';'.$value['I'];
				}else{
					$buyGoodCategorys .= '-'.$value['E'];//同一站点商品类别用-分隔
					$buyMoneySums .= '-'.$value['F'];
					$sellGoodCategorys .= '-'.$value['H'];
					$sellMoneySums .= '-'.$value['I'];
				}
			}
		}

		$dailySheet->id = Common::create40ID();
		$dailySheet->siteId = '';
		$dailySheet->dealId = '';
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

		unlink($attachUrls);//删除上传的Excel

		if($dailySheet->save()){
			return "success";
		}else{
			return "format wrong";
		}
	}
}