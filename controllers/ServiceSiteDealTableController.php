<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/22
 * Time: 22:10
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

/**
 * Class ServiceSiteDealTableController
 * @package app\controllers
 */
class ServiceSiteDealTableController extends Controller{

	/**
	 * 默认方法，前往首页
	 * @return string
	 */
	public function actionIndex(){

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

		/*$edit = Common::resource('ADMIN','EDIT1');
		$delete = Common::resource('ADMIN','DELETE');*/

		return $this->render('index',[
			'serviceSites' => $models,
			'pages' => $pages,
			/*'edit' => $edit,
			'delete' => $delete*/
		]);
	}

	/**
	 * 根据ID查询一个站点的信息
	 * @return string
	 */
	public function actionFindOne(){

		$siteId = Yii::$app->request->get('id');

		//连接查询站点的基础信息
		$query = new Query();
		$serviceSite = $query->select('a.id as id,a.code as code,a.name as name,a.countyType as countyType,b.chargeName as chargeName,b.chargeMobile as chargeMobile,b.address as address,b.picUrl as picUrl')
			->from('servicesite a')
			->where("a.id = :id",[':id' => $siteId])
			->leftJoin('servicesiteinfo b','a.id = b.siteId')
			->one();

		//字典反转
		$dictItem = Dictitem::find()
			->where(['dictCode' => 'DICT_COUNTYTYPE'])
			->all();
		foreach ($dictItem as $index => $value) {
			if (!empty($value->dictItemCode)) {
				if ($value->dictItemCode == $serviceSite['countyType']) {
					if (!empty($value->dictItemName)) {
						$serviceSite['countyType'] = $value->dictItemName;
					}
				}
			}
		}

		return $this->render('detail',[
			'serviceSite' => $serviceSite
		]);
	}

	/**
	 * 查询部分信息，前往添加交易信息
	 * @return string
	 */
	public function actionDealTable(){

		$siteId = Yii::$app->request->get('id');

		$site = ServiceSite::findOne($siteId);
		$serviceSite = [];
		$serviceSite['id'] = $siteId;
		$serviceSite['code'] = $site->code;
		$serviceSite['name'] = $site->name;

		return $this->render('deal',[
			'serviceSite' => $serviceSite
		]);
	}

	/**
	 * 保存一个日交易信息表
	 * @return bool|string
	 */
	public function actionAddOne(){

		$siteId = Yii::$app->request->post('id');
		$buyCategory = Yii::$app->request->post('buyCategory');
		$buySum = Yii::$app->request->post('buySum');
		$buyTotal = Yii::$app->request->post('buyTotal');
		$sellCategory = Yii::$app->request->post('sellCategory');
		$sellSum = Yii::$app->request->post('sellSum');
		$sellTotal = Yii::$app->request->post('sellTotal');

		$dealTable = new ServiceSiteDealTable();
		$dealTable->id = Common::create40ID();
		$dealTable->siteId = $siteId;
		$dealTable->date = date("Y-m-d");
		$dealTable->buyGoodCategory = $buyCategory;
		$dealTable->buyMoneySum = $buySum;
		$dealTable->buyOrderTotal = $buyTotal;
		$dealTable->sellGoodCategory = $sellCategory;
		$dealTable->sellMoneySum = $sellSum;
		$dealTable->sellOrderTotal = $sellTotal;

		if($dealTable->save()){
			return "success";
		}else{
			return false;
		}
	}
}