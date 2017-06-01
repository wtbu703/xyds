<?php
/**
 * Author: luoao,li
 * Date: 2017/3/16
 * Time: 11:24
 * Function:
 */
namespace app\controllers;

use yii;
use yii\base\Controller;
use app\common\Common;
use app\models\ThirdPartyService;
use app\models\Dictitem;
use yii\data\Pagination;
use yii\helpers\Json;

/**
 * 第三方服务
 * Class ThirdPartyServiceController
 * @package app\controllers
 */
class ThirdPartyServiceController extends Controller{

	/**
	 * 前往首页
	 * @return string
	 */
	public function actionIndex(){
		return $this->render('index');
	}

	/**
	 * 前往新增页
	 * @return string
	 */
	public function actionAdd(){
		return $this->render('add');
	}

	/**
	 * 上传照片
	 * @return string
	 */
	public function actionUpload(){

		if (Yii::$app->request->isPost) {

			$fileArg = Common::upload($_FILES,true,false, 'third_company',2048000);
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
	 * 新增一条记录
	 * @return bool|string
	 */
	public function actionAddOne(){

		$serviceSystemBuild = new ThirdPartyService();
		$serviceSystemBuild->id = Common::create40ID();
		$serviceSystemBuild->companyName = Yii::$app->request->post('companyName');
		$serviceSystemBuild->logoUrl = Yii::$app->request->post('logoUrl');
		$serviceSystemBuild->introduction = Yii::$app->request->post('introduction');
		$serviceSystemBuild->tel = Yii::$app->request->post('tel');
		$serviceSystemBuild->email = Yii::$app->request->post('email');
		$serviceSystemBuild->address = Yii::$app->request->post('address');
		$serviceSystemBuild->fax = Yii::$app->request->post('fax');
		$serviceSystemBuild->postcode = Yii::$app->request->post('postcode');
		$serviceSystemBuild->content = Yii::$app->request->post('content');
		$serviceSystemBuild->contact = Yii::$app->request->post('contact');
		$serviceSystemBuild->sources = Yii::$app->request->post('sources');
		$serviceSystemBuild->category = Yii::$app->request->post('category');
		$serviceSystemBuild->datetime = date('Y-m-d H:i:s');
		if($serviceSystemBuild->save()){
			return 'success';
		}else{
			return false;
		}
	}

	/**
	 * 根据条件查询
	 * @return string
	 */
	public function actionFindByAttri(){
		//收查询条件如果存在
		$name = Yii::$app->request->get('companyName');
		$category = Yii::$app->request->get('category');

		//换页时保存查询条件
		$para= [];
		$para['companyName'] = $name;

		//组装查询语句
		$whereStr = '1=1';
		if($name != ''){
			$whereStr = $whereStr." and companyName like '%".$name."%'";
		}
		if($category != ''){
			$whereStr = $whereStr." and category like '%".$category."%'";
		}

		$serviceSystemBuilds = ThirdPartyService::find()
			->where($whereStr);
		//分页
		$pages = new Pagination([
			'totalCount' =>$serviceSystemBuilds->count(),
			'pageSize' => Common::PAGESIZE
		]);
		$models = $serviceSystemBuilds
			->orderBy(['publicTime'=>SORT_DESC])
			->offset($pages->offset)
			->limit($pages->limit)
			->all();

		//字典反转
		$category = Dictitem::find()->where(['dictCode'=>'DICT_COMPANY_CATEGORY'])->all();
		foreach($models as $key=>$data) {
			foreach ($category as $index => $value) {
				if ($data->category == $value->dictItemCode) {
					$models[$key]->category = $value->dictItemName;
				}
			}
		}

		return $this->render('listall',[
			'thirdPartyServices' => $models,
			'pages' => $pages,
			'para' => $para
		]);
	}

	/**
	 * 根据条件查询
	 * @return bool|string
	 */
	public function actionFindOne(){

		$buildId = Yii::$app->request->get('id');
		$action = Yii::$app->request->get('action');

		$serviceSystemBuild = ThirdPartyService::findOne($buildId);
		$category = Dictitem::find()->where(['dictCode' => 'DICT_COMPANY_CATEGORY'])->all();

		//如果是详情页
		if($action == 'detail'){
			foreach ($category as $index => $value) {
				if ($serviceSystemBuild->category == $value->dictItemCode) {
					$serviceSystemBuild->category = $value->dictItemName;
				}
			}

			return $this->render('detail',[
				'ThirdPartyService' => $serviceSystemBuild
			]);
		} elseif($action == 'update')//如果是修改页
		{
			return $this->render('update',[
				'ThirdPartyService' => $serviceSystemBuild,
				'category'=>$category,
			]);
		}else{
			return false;
		}

	}

	/**
	 * 根据ID保存修改
	 * @return bool|string
	 */
	public function actionUpdateOne(){

		$id = Yii::$app->request->post("id");
		$companyName = Yii::$app->request->post("companyName");
		$logoUrl = Yii::$app->request->post("logoUrl");
		$introduction = Yii::$app->request->post("introduction");
		$tel = Yii::$app->request->post("tel");
		$email = Yii::$app->request->post("email");
		$address = Yii::$app->request->post("address");
		$fax = Yii::$app->request->post("fax");
		$postcode = Yii::$app->request->post("postcode");
		$content = Yii::$app->request->post('content');
		$contact = Yii::$app->request->post('contact');
		$sources = Yii::$app->request->post('sources');
		$category = Yii::$app->request->post('category');
		$publicTime = date('Y-m-d H:m:s');
		$serviceSite = ThirdPartyService::findOne($id);
		if($companyName != ''){
			$serviceSite->companyName = $companyName;
		}
		if($logoUrl != ''){
			if(!is_null($serviceSite->logoUrl)&&file_exists($serviceSite->logoUrl)){//如果有图片链接
				unlink($serviceSite->logoUrl);//就删除图片文件
			}
			$serviceSite->logoUrl = $logoUrl;
		}
		if($introduction != ''){
			$serviceSite->introduction = $introduction;
		}
		if($tel != ''){
			$serviceSite->tel = $tel;
		}
		if($email != ''){
			$serviceSite->email = $email;
		}
		if($address != ''){
			$serviceSite->address = $address;
		}
		if($fax != ''){
			$serviceSite->fax = $fax;
		}
		if($postcode != ''){
			$serviceSite->postcode = $postcode;
		}if($content != ''){
			$serviceSite->content = $content;
		}if($publicTime != ''){
			$serviceSite->publicTime = $publicTime;
		}if($contact != ''){
			$serviceSite->contact = $contact;
		}if($sources != ''){
			$serviceSite->sources = $sources;
		}if($category != ''){
			$serviceSite->category = $category;
		}
		$serviceSite->datetime = date('Y-m-d H:i:s');


		if($serviceSite->save()){
			return "success";
		}else{
			return false;
		}
	}

	/**
	 * 根据ID删除一条
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteOne(){

		$id = Yii::$app->request->post('id');

		$serviceSystemBuild = ThirdPartyService::findOne($id);
		$picUrl = $serviceSystemBuild['logoUrl'];//获取表中图片路径字段

		if(!is_null($picUrl)&&file_exists($picUrl)){//如果有图片文件
			//根据路径删除图片文件
			unlink($picUrl);
		}
		if($serviceSystemBuild->delete()){
			return "success";
		}else{
			return "fail";
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
			$serviceSystemBuild = ThirdPartyService::findOne($data);
			if(!is_null($serviceSystemBuild['logoUrl'])&&file_exists($serviceSystemBuild['logoUrl'])){//如果有图片文件
				unlink($serviceSystemBuild['logoUrl']);//根据路径删除文件
			}
			$serviceSystemBuild->delete();//根据ID删除
		}
		return 'success';
	}

	/**
	 * @return string
	 * 获取第三方服务列表
	 */
	public function actionAjax(){
		$cat = Yii::$app->request->post('cat');
		$tag = Yii::$app->request->post('tag');
		$page = Yii::$app->request->post('page');
		if($cat == '-1'){
			if($tag == '-1') {
				$query = ThirdPartyService::find()
						->count();
				$pagination = new Pagination([
						'page' => $page,
						'defaultPageSize' => 12,
						'validatePage' => false,
						'totalCount' => $query,
				]);
				$third = ThirdPartyService::find()
						->offset($pagination->offset)
						->limit($pagination->limit)
						->all();
				$para = [];
				$para['third'] = Json::encode($third);
				$para['page'] = $page;
				$para['pageSize'] = $pagination->defaultPageSize;
				$para['totalCount'] = $pagination->totalCount;

				return Json::encode($para);
			}else{
				$query = ThirdPartyService::find()
						->where("companyName like '%" . $tag . "%'")
						->count();
				$pagination = new Pagination([
						'page' => $page,
						'defaultPageSize' => 12,
						'validatePage' => false,
						'totalCount' => $query,
				]);
				$third = ThirdPartyService::find()
						->where("companyName like '%" . $tag . "%'")
						->offset($pagination->offset)
						->limit($pagination->limit)
						->all();
				$para = [];
				$para['third'] = Json::encode($third);
				$para['page'] = $page;
				$para['pageSize'] = $pagination->defaultPageSize;
				$para['totalCount'] = $pagination->totalCount;

				return Json::encode($para);
			}
		}else{
			$query = ThirdPartyService::find()
					->where('category = :cat',[":cat"=>$cat])
					->count();
			$pagination = new Pagination([
					'page' => $page,
					'defaultPageSize' => 12,
					'validatePage' => false,
					'totalCount' => $query,
			]);
			$third = ThirdPartyService::find()
					->where('category = :cat',[":cat"=>$cat])
					->offset($pagination->offset)
					->limit($pagination->limit)
					->all();
			$para = [];
			$para['third'] = Json::encode($third);
			$para['page'] = $page;
			$para['pageSize'] = $pagination->defaultPageSize;
			$para['totalCount'] = $pagination->totalCount;
			return Json::encode($para);
		}

	}
}