<?php
/**
 * Author: luoao,li
 * Date: 2017/2/28
 * Time: 18:07
 * Function:
 */
namespace app\controllers;

use yii;
use yii\base\Controller;
use app\common\Common;
use app\models\SupportLaunch;
use yii\data\Pagination;

class SupportLaunchController extends Controller{

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
	 * 上传决策文件
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
	 * 新增一条记录
	 * @return bool|string
	 */
	public function actionAddOne(){

		$serviceSystemBuild = new SupportLaunch();
		$serviceSystemBuild->id = Common::create40ID();
		$serviceSystemBuild->name = Yii::$app->request->post('name');
		$serviceSystemBuild->centralSupportContent = Yii::$app->request->post('centralSupportContent');
		$serviceSystemBuild->centralSupport = Yii::$app->request->post('centralSupport');
		$serviceSystemBuild->centralPaid = Yii::$app->request->post('centralPaid');
		$serviceSystemBuild->localSupport = Yii::$app->request->post('localSupport');
		$serviceSystemBuild->companyPaid = Yii::$app->request->post('companyPaid');
		$serviceSystemBuild->organizer = Yii::$app->request->post('organizer');
		$serviceSystemBuild->chargeName = Yii::$app->request->post('chargeName1');
		$serviceSystemBuild->chargeMobile = Yii::$app->request->post('chargeMobile1');
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

	/**
	 * 根据条件查询
	 * @return string
	 */
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

		$serviceSystemBuilds = SupportLaunch::find()
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

		return $this->render('listall',[
			'supportLaunchs' => $models,
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

		$serviceSystemBuild = SupportLaunch::findOne($buildId);

		//如果是详情页
		if($action == 'detail'){

			return $this->render('detail',[
				'supportLaunch' => $serviceSystemBuild
			]);
		} elseif($action == 'update')//如果是修改页
		{

			return $this->render('update',[
				'supportLaunch' => $serviceSystemBuild
			]);
		}else{
			return false;
		}

	}

	/**
	 * 根据ID修改一条记录
	 * @return bool|string
	 */
	public function actionUpdateOne(){

		$serviceSystemBuild = SupportLaunch::findOne(Yii::$app->request->post('id'));
		$serviceSystemBuild->name = Yii::$app->request->post('name');
		$serviceSystemBuild->centralSupportContent = Yii::$app->request->post('centralSupportContent');
		$serviceSystemBuild->centralSupport = Yii::$app->request->post('centralSupport');
		$serviceSystemBuild->centralPaid = Yii::$app->request->post('centralPaid');
		$serviceSystemBuild->localSupport = Yii::$app->request->post('localSupport');
		$serviceSystemBuild->companyPaid = Yii::$app->request->post('companyPaid');
		$serviceSystemBuild->organizer = Yii::$app->request->post('organizer');
		$serviceSystemBuild->chargeName = Yii::$app->request->post('chargeName1');
		$serviceSystemBuild->chargeMobile = Yii::$app->request->post('chargeMobile1');
		$serviceSystemBuild->publicInfoUrl = Yii::$app->request->post('publicInfoUrl');
		if($serviceSystemBuild->save()){
			return 'success';
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

		$serviceSystemBuild = SupportLaunch::findOne($id);
		$picUrl = $serviceSystemBuild['decisionFileUrl'];//获取表中图片路径字段

		//根据ID删除site,siteinfo,并根据路径删除图片文件
		if($serviceSystemBuild->delete()&&unlink($picUrl)){
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
			$serviceSystemBuild = SupportLaunch::findOne($data);
			unlink($serviceSystemBuild['decisionFileUrl']);//根据路径删除文件
			$serviceSystemBuild->delete();//根据ID删除
		}
		return 'success';
	}
}