<?php
namespace app\controllers;

use yii;
use yii\base\Controller;
use app\common\Common;
use app\models\ServiceSite;
use app\models\ServiceSiteInfo;
use app\models\ServiceSystemBuild;
use yii\data\Pagination;
use app\models\Dictitem;

class ServiceSystemBuildController extends Controller{

	public function actionIndex(){
		return $this->render('index');
	}

	public function actionAdd(){
		return $this->render('add');
	}

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

	public function actionAddOne(){

		$serviceSystemBuild = new ServiceSystemBuild();
		$serviceSystemBuild->id = Common::create40ID();
		$serviceSystemBuild->name = Yii::$app->request->post('name');
		$serviceSystemBuild->address = Yii::$app->request->post('address');
		$serviceSystemBuild->function = Yii::$app->request->post('function');
		$serviceSystemBuild->chargeName = Yii::$app->request->post('chargeName');
		$serviceSystemBuild->chargeMobile = Yii::$app->request->post('chargeMobile');
		$serviceSystemBuild->code = Yii::$app->request->post('code');
		$serviceSystemBuild->isCountyLogistics = Yii::$app->request->post('isCountyLogistics');
		$serviceSystemBuild->isTownLogistics = Yii::$app->request->post('isTownLogistics');
		$serviceSystemBuild->config = Yii::$app->request->post('config');
		$serviceSystemBuild->centralSupportContent = Yii::$app->request->post('centralSupportContent');
		$serviceSystemBuild->buildProgress = Yii::$app->request->post('buildProgress');
		$serviceSystemBuild->centralSupport = Yii::$app->request->post('centralSupport');
		$serviceSystemBuild->centralPaid = Yii::$app->request->post('centralPaid');
		$serviceSystemBuild->localSupport = Yii::$app->request->post('localSupport');
		$serviceSystemBuild->companyPaid = Yii::$app->request->post('companyPaid');
		$serviceSystemBuild->organizer = Yii::$app->request->post('organizer');
		$serviceSystemBuild->chargeName1 = Yii::$app->request->post('chargeName1');
		$serviceSystemBuild->chargeMobile1 = Yii::$app->request->post('chargeMobile1');
		$serviceSystemBuild->centralDecisionUnit = Yii::$app->request->post('centralDecisionUnit');
		$serviceSystemBuild->decisionFileUrl = Yii::$app->request->post('decisionFileUrl');
		$serviceSystemBuild->publicInfoUrl = Yii::$app->request->post('publicInfoUrl');
		$serviceSystemBuild->published = date('Y-m-d');
		if($serviceSystemBuild->save()){
			return 'success';
		}else{
			return false;
		}
	}

	public function actionFindByAttri(){
		//收查询条件如果存在
		$name = Yii::$app->request->get('name');

		//换页时保存查询条件
		$para= [];
		$para['name'] = $name;

		//组装查询语句
		$whereStr = '1=1';
		if($name != ''){
			$whereStr = $whereStr." and name like '%".$name."%'";
		}

		$serviceSystemBuilds = ServiceSystemBuild::find()
			->where($whereStr);
		//分页
		$pages = new Pagination([
			'totalCount' =>$serviceSystemBuilds->count(),
			'pageSize' => Common::PAGESIZE
		]);
		$models = $serviceSystemBuilds
			->offset($pages->offset)
			->limit($pages->limit)
			->all();


		foreach($models as $key=>$data) {
			if ($data->isCountyLogistics == '0') {
				$models[$key]->isCountyLogistics = '否';
			}elseif($data->isCountyLogistics == '1'){
				$models[$key]->isCountyLogistics = '是';
			}
			if ($data->isTownLogistics == '0') {
				$models[$key]->isTownLogistics = '否';
			}elseif($data->isTownLogistics == '1'){
				$models[$key]->isTownLogistics = '是';
			}
		}

		return $this->render('listall',[
			'serviceSystemBuilds' => $models,
			'pages' => $pages,
			'para' => $para
		]);
	}

	public function actionFindOne(){

		$buildId = Yii::$app->request->get('id');
		$action = Yii::$app->request->get('action');

		$serviceSystemBuild = ServiceSystemBuild::findOne($buildId);

		//如果是详情页
		if($action == 'detail'){

			if ($serviceSystemBuild->isCountyLogistics == '0') {
				$serviceSystemBuild->isCountyLogistics = '否';
			}elseif($serviceSystemBuild->isCountyLogistics == '1'){
				$serviceSystemBuild->isCountyLogistics = '是';
			}
			if ($serviceSystemBuild->isTownLogistics == '0') {
				$serviceSystemBuild->isTownLogistics = '否';
			}elseif($serviceSystemBuild->isTownLogistics == '1'){
				$serviceSystemBuild->isTownLogistics = '是';
			}

			return $this->render('detail',[
				'serviceSystemBuild' => $serviceSystemBuild
			]);
		} elseif($action == 'update')//如果是修改页
		{

			return $this->render('update',[
				'serviceSystemBuild' => $serviceSystemBuild
			]);
		}else{
			return false;
		}

	}

	public function actionUpdateOne(){

		$serviceSystemBuild = ServiceSystemBuild::findOne(Yii::$app->request->post('id'));
		$serviceSystemBuild->name = Yii::$app->request->post('name');
		$serviceSystemBuild->address = Yii::$app->request->post('address');
		$serviceSystemBuild->function = Yii::$app->request->post('function');
		$serviceSystemBuild->chargeName = Yii::$app->request->post('chargeName');
		$serviceSystemBuild->chargeMobile = Yii::$app->request->post('chargeMobile');
		$serviceSystemBuild->code = Yii::$app->request->post('code');
		$serviceSystemBuild->isCountyLogistics = Yii::$app->request->post('isCountyLogistics');
		$serviceSystemBuild->isTownLogistics = Yii::$app->request->post('isTownLogistics');
		$serviceSystemBuild->config = Yii::$app->request->post('config');
		$serviceSystemBuild->centralSupportContent = Yii::$app->request->post('centralSupportContent');
		$serviceSystemBuild->buildProgress = Yii::$app->request->post('buildProgress');
		$serviceSystemBuild->centralSupport = Yii::$app->request->post('centralSupport');
		$serviceSystemBuild->centralPaid = Yii::$app->request->post('centralPaid');
		$serviceSystemBuild->localSupport = Yii::$app->request->post('localSupport');
		$serviceSystemBuild->companyPaid = Yii::$app->request->post('companyPaid');
		$serviceSystemBuild->organizer = Yii::$app->request->post('organizer');
		$serviceSystemBuild->chargeName1 = Yii::$app->request->post('chargeName1');
		$serviceSystemBuild->chargeMobile1 = Yii::$app->request->post('chargeMobile1');
		$serviceSystemBuild->publicInfoUrl = Yii::$app->request->post('publicInfoUrl');
		if($serviceSystemBuild->save()){
			return 'success';
		}else{
			return false;
		}
	}

	public function actionDeleteOne(){

		$id = Yii::$app->request->post('id');

		$serviceSystemBuild = ServiceSystemBuild::findOne($id);
		$picUrl = $serviceSystemBuild['decisionFileUrl'];//获取表中图片路径字段

		//根据ID删除site,siteinfo,并根据路径删除图片文件
		if($serviceSystemBuild->delete()&&unlink($picUrl)){
			return "success";
		}else{
			return "fail";
		}
	}

	public function actionDeleteMore(){

		$ids = Yii::$app->request->post("ids");
		$id_array = explode('-',$ids);

		foreach($id_array as $key => $data){
			$serviceSystemBuild = ServiceSystemBuild::findOne($data);
			unlink($serviceSystemBuild['decisionFileUrl']);//根据路径删除文件
			$serviceSystemBuild->delete();//根据ID删除
		}
		return 'success';
	}
}