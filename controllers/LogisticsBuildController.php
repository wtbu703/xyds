<?php
/**
 * Author: luoao,li
 * Date: 2017/3/1
 * Time: 18:03
 * Function:
 */
namespace app\controllers;

use yii;
use yii\base\Controller;
use app\common\Common;
use app\models\LogisticsBuild;
use yii\data\Pagination;

class LogisticsBuildController extends Controller{

	/**
	 * 前往index页面
	 * @return string
	 */
	public function actionIndex(){
		return $this->render('index');
	}

	/**
	 * 前往新增页面
	 * @return string
	 */
	public function actionAdd(){
		return $this->render('add');
	}

	/**
	 * 新增一条记录到数据库
	 * @return bool|string
	 */
	public function actionAddOne(){

		$serviceSystemBuild = new LogisticsBuild();
		$serviceSystemBuild->id = Common::create40ID();
		$serviceSystemBuild->townCover = Yii::$app->request->post('townCover');
		$serviceSystemBuild->countyToVillage = Yii::$app->request->post('countyToVillage');
		$serviceSystemBuild->villageCover = Yii::$app->request->post('villageCover');
		$serviceSystemBuild->villageToHamlet = Yii::$app->request->post('villageToHamlet');
		$serviceSystemBuild->receiveNum = Yii::$app->request->post('receiveNum');
		$serviceSystemBuild->sendNum = Yii::$app->request->post('sendNum');
		$serviceSystemBuild->orderBy = Yii::$app->request->post('orderBy');
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
		$published = Yii::$app->request->get('published');

		//换页时保存查询条件
		$para= [];
		$para['published'] = $published;

		//组装查询语句
		$whereStr = '1=1';
		if($published != ''){
			$whereStr = $whereStr." and published = '".$published."'";
		}

		$serviceSystemBuilds = LogisticsBuild::find()
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
			'logisticsBuilds' => $models,
			'pages' => $pages,
			'para' => $para
		]);
	}

	/**
	 * 根据ID查询一条
	 * @return bool|string
	 */
	public function actionFindOne(){

		$buildId = Yii::$app->request->get('id');
		$action = Yii::$app->request->get('action');

		$serviceSystemBuild = LogisticsBuild::findOne($buildId);

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
	 * 根据ID修改一条
	 * @return bool|string
	 */
	public function actionUpdateOne(){

		$serviceSystemBuild = LogisticsBuild::findOne(Yii::$app->request->post('id'));
		$serviceSystemBuild->townCover = Yii::$app->request->post('townCover');
		$serviceSystemBuild->countyToVillage = Yii::$app->request->post('countyToVillage');
		$serviceSystemBuild->villageCover = Yii::$app->request->post('villageCover');
		$serviceSystemBuild->villageToHamlet = Yii::$app->request->post('villageToHamlet');
		$serviceSystemBuild->receiveNum = Yii::$app->request->post('receiveNum');
		$serviceSystemBuild->sendNum = Yii::$app->request->post('sendNum');
		$serviceSystemBuild->orderBy = Yii::$app->request->post('orderBy');
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

		$serviceSystemBuild = LogisticsBuild::findOne($id);
		if($serviceSystemBuild->delete()){
			return "success";
		}else{
			return "fail";
		}
	}

	/**
	 * 根据ID多选删除
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteMore(){

		$ids = Yii::$app->request->post("ids");
		$id_array = explode('-',$ids);

		foreach($id_array as $key => $data){
			LogisticsBuild::findOne($data)->delete();
		}
		return 'success';
	}

	/**
	 * 数据统计对物流的查询
	 * @return bool|string
	 */
	public function actionAjax(){
		$type = Yii::$app->request->post('type');
		if($type==2){//快递覆盖率，月，村、行政村
			$sql = Yii::$app->getDb()->createCommand("SELECT DATE_FORMAT(published,'%Y-%m')AS months,COUNT(townCover)AS townCover,COUNT(villageCover)AS villageCover FROM logisticsbuild GROUP BY DATE_FORMAT(published,'%Y-%m')");
			$res = $sql->queryAll();
			return yii\helpers\Json::encode($res);
		}else if($type==3){//快递企业数量，县到乡、乡到村
			$sql = Yii::$app->getDb()->createCommand("SELECT DATE_FORMAT(published,'%Y-%m')AS months,COUNT(countyToVillage)AS countyToVillage,COUNT(villageToHamlet)AS villageToHamlet FROM logisticsbuild GROUP BY DATE_FORMAT(published,'%Y-%m')");
			$res = $sql->queryAll();
			return yii\helpers\Json::encode($res);
		}else if($type==4){//县快递量，收、发
			$sql = Yii::$app->getDb()->createCommand("SELECT DATE_FORMAT(published,'%Y-%m')AS months,COUNT(receiveNum)AS receiveNum,COUNT(sendNum)AS sendNum FROM logisticsbuild GROUP BY DATE_FORMAT(published,'%Y-%m')");
			$res = $sql->queryAll();
			return yii\helpers\Json::encode($res);
		}else{
			return false;
		}
	}
}