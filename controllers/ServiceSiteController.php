<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/18
 * Time: 18:38
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

/**
 * Class ServiceSiteController
 * @package app\controllers
 */
class ServiceSiteController extends Controller{

	/**
	 * 默认方法
	 * @return string
	 */
	public function actionIndex(){

		/*$add = Common::resource('ADMIN','ADD');
		$excel = Common::resource('ADMIN','EXCEL');*/
		return $this->render('index'/*,[
			'add' => $add,
			'excel' => $excel
		]*/);
	}

	/**
	 * 前往添加站点页
	 * @return string
	 */
	public function actionAdd(){

		return $this->render('add');
	}

	/**
	 * 上传站点照片
	 * @return string
	 */
	public function actionUpload(){

		if (Yii::$app->request->isPost) {

			$fileArg = Common::upload($_FILES,true,false);
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
	 * 保存信息到库
	 * @return string
	 */
	public function actionAddOne(){

		//code,name,countyType是servicesite表
		$serviceSite = new ServiceSite();
		$siteId = Common::create40ID();
		$serviceSite->id = $siteId;
		$serviceSite->code = Yii::$app->request->post('code');
		$serviceSite->name = Yii::$app->request->post('name');
		$serviceSite->countyType = Yii::$app->request->post('type');

		//chargeName,chargeMobile,address,picUrl是servicesiteinfo表
		$serviceSiteInfo = new ServiceSiteInfo();
		$serviceSiteInfo->id = Common::create40ID();
		$serviceSiteInfo->siteId = $siteId;
		$serviceSiteInfo->chargeName = Yii::$app->request->post('chargeName');
		$serviceSiteInfo->chargeMobile = Yii::$app->request->post('chargeMobile');
		$serviceSiteInfo->address = Yii::$app->request->post('address');
		$serviceSiteInfo->picUrl = Yii::$app->request->post('attachUrls');

		if($serviceSite->save() && $serviceSiteInfo->save())//两个表都成功插入
		{
			return "success";
		}
		else
		{
			return "fail";
		}
	}

	/**
	 * 检查站点编码是否重复
	 * @return string
	 */
	public function actionCheckCode(){

		$code = Yii::$app->request->get('code');
		$oldCode = Yii::$app->request->post('oldCode');
		if($oldCode=='null')//来自add
		{
			$serviceSite = ServiceSite::find()
				->where(['code' => $code])
				->one();
			if(is_null($serviceSite))
			{
				return "success";
			}else
			{
				return "exist";
			}
		}elseif($code==$oldCode)//来自update并且没有改变
		{
			return 'success';
		}elseif($code!=$oldCode)//来自update且有改变
		{
			$serviceSite = ServiceSite::find()
				->where(['code' => $code])
				->one();
			if(is_null($serviceSite))
			{
				return "success";
			}else
			{
				return "exist";
			}
		}else{
			return false;
		}
	}

	/**
	 * 按条件查询显示主列表
	 * @return string
	 */
	public function actionFindByAttri(){
		//收查询条件如果存在
		$code = Yii::$app->request->get('code');
		$name = Yii::$app->request->get('name');
		$type = Yii::$app->request->get('type');

		//换页时保存查询条件
		$para= [];
		$para['code'] = $code;
		$para['name'] = $name;
		$para['type'] = $type;

		//组装查询语句
		$whereStr = '1=1';
		if($code != ''){
			$whereStr = $whereStr." and code like '%".$code."%'";
		}
		if($name != ''){
			$whereStr = $whereStr." and name like '%".$name."%'";
		}
		if($type != ''){
			$whereStr = $whereStr." and countyType=".$type;
		}

		$serviceSites = ServiceSite::find()
			->where($whereStr);
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
		return $this->render('listall',[
			'serviceSites' => $models,
			'pages' => $pages,
			'para' => $para,
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
		$action = Yii::$app->request->get('action');
		//$serviceSite = ServiceSite::findOne($siteId);

		//连接查询站点的基础信息
		$query = new Query();
		$serviceSite = $query->select('a.id as id,a.code as code,a.name as name,a.countyType as countyType,b.chargeName as chargeName,b.chargeMobile as chargeMobile,b.address as address,b.picUrl as picUrl')
			->from('servicesite a')
			->where("a.id = :id",[':id' => $siteId])
			->leftJoin('servicesiteinfo b','a.id = b.siteId')
			->one();

		//如果是详情页
		if($action == 'detail'){
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
		} elseif($action == 'update')//如果是修改页
		{
			$typeDict = Dictitem::find()
				->where(['dictCode' => 'DICT_COUNTYTYPE'])
				->all();
			return $this->render('update',[
				'serviceSite' => $serviceSite,
				'typeDict' => $typeDict,
			]);
		}else{
			return false;
		}

	}

	/**
	 * 根据ID删除一个站点
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteOne(){

		$siteId = Yii::$app->request->post('id');

		$serviceSiteInfo = ServiceSiteInfo::find()
			->where('siteId = :id',[':id' => $siteId])
			->one();
		$picUrl = $serviceSiteInfo['picUrl'];//获取表中图片路径字段

		//根据ID删除site,siteinfo,并根据路径删除图片文件
		if(ServiceSite::findOne($siteId)->delete()&&$serviceSiteInfo->delete()&&unlink($picUrl)){
			return "success";
		}else{
			return "fail";
		}
	}

	/**
	 * 根据ID删除多个站点
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteMore(){

		$ids = Yii::$app->request->post("ids");
		$id_array = explode('-',$ids);

		foreach($id_array as $key => $data){
			ServiceSite::findOne($data)->delete();//根据ID删除site
			$serviceSiteInfo = ServiceSiteInfo::find()
				->where('siteId = :id',[':id' => $data])
				->one();
			$picUrl = $serviceSiteInfo['picUrl'];
			unlink($picUrl);//根据路径删除图片文件
			$serviceSiteInfo->delete();//根据ID删除siteinfo
		}
		return 'success';
	}

	/**
	 * 根据ID保存修改
	 * @return bool|string
	 */
	public function actionUpdateOne(){

		$id = Yii::$app->request->post("id");
		$code = Yii::$app->request->post("code");
		$name = Yii::$app->request->post("name");
		$type = Yii::$app->request->post("type");
		$chargeName = Yii::$app->request->post("chargeName");
		$chargeMobile = Yii::$app->request->post("chargeMobile");
		$address = Yii::$app->request->post("address");
		$attachUrls = Yii::$app->request->post("attachUrls");

		$serviceSite = ServiceSite::findOne($id);
		if($code != ''){
			$serviceSite->code = $code;
		}
		if($name != ''){
			$serviceSite->name = $name;
		}
		if($type != ''){
			$serviceSite->countyType = $type;
		}

		$serviceSiteInfo = ServiceSiteInfo::find()
			->where('siteId = :siteId',[":siteId" => $id])
			->one();
		if($chargeName != ''){
			$serviceSiteInfo['chargeName'] = $chargeName;
		}
		if($chargeMobile != ''){
			$serviceSiteInfo['chargeMobile'] = $chargeMobile;
		}
		if($address != ''){
			$serviceSiteInfo['address'] = $address;
		}
		if($attachUrls != ''){
			$picUrl = $serviceSiteInfo['picUrl'];
			unlink($picUrl);
			$serviceSiteInfo['picUrl'] = $attachUrls;
		}
		if($serviceSite->save()&&$serviceSiteInfo->save()){
			return "success";
		}else{
			return false;
		}
	}
}