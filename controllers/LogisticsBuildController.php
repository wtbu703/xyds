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

	public function actionIndex(){
		return $this->render('index');
	}

	public function actionAdd(){
		return $this->render('add');
	}

	public function actionAddOne(){

		$serviceSystemBuild = new LogisticsBuild();
		$serviceSystemBuild->id = Common::create40ID();
		$serviceSystemBuild->townCover = Yii::$app->request->post('townCover');
		$serviceSystemBuild->villageCover = Yii::$app->request->post('villageCover');
		$serviceSystemBuild->receiveNum = Yii::$app->request->post('receiveNum');
		$serviceSystemBuild->orderBy = Yii::$app->request->post('orderBy');
		$serviceSystemBuild->published = date('Y-m-d');
		if($serviceSystemBuild->save()){
			return 'success';
		}else{
			return false;
		}
	}

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

	public function actionUpdateOne(){

		$serviceSystemBuild = LogisticsBuild::findOne(Yii::$app->request->post('id'));
		$serviceSystemBuild->townCover = Yii::$app->request->post('townCover');
		$serviceSystemBuild->villageCover = Yii::$app->request->post('villageCover');
		$serviceSystemBuild->receiveNum = Yii::$app->request->post('receiveNum');
		$serviceSystemBuild->orderBy = Yii::$app->request->post('orderBy');
		if($serviceSystemBuild->save()){
			return 'success';
		}else{
			return false;
		}
	}

	public function actionDeleteOne(){

		$id = Yii::$app->request->post('id');

		$serviceSystemBuild = LogisticsBuild::findOne($id);
		if($serviceSystemBuild->delete()){
			return "success";
		}else{
			return "fail";
		}
	}

	public function actionDeleteMore(){

		$ids = Yii::$app->request->post("ids");
		$id_array = explode('-',$ids);

		foreach($id_array as $key => $data){
			LogisticsBuild::findOne($data)->delete();
		}
		return 'success';
	}
}