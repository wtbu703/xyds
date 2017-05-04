<?php
/**
 * Author: luoao,li
 * Date: 2017/3/28
 * Time: 17:51
 * Function:
 */
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Pic;
use yii\data\Pagination;
use app\common\Common;
use app\models\Dictitem;
use yii\helpers\Json;

class PicController extends Controller{

	public $enableCsrfValidation = false;

	/**
	 * @return string
	 */
	public function actionIndex(){
		return $this->render('index');
	}

	/**
	 * @return string
	 */
	public function actionAdd(){
		return $this->render('add');
	}

	/**
	 * 插入一条记录
	 * @return string|void
	 */
	public function actionAddOne(){

		$pic = new Pic();
		$pic->id = Common::create40ID();
		$pic->category = Yii::$app->request->post('category');
		$pic->url = Yii::$app->request->post('url');

		if($pic->save()){
			return 'success';
		}else{
			return false;
		}
	}

	/**
	 * 根据条件查找多条记录
	 * @return string
	 */
	public function actionFindByAttri(){
		//收查询条件如果存在
		$categoryName = Yii::$app->request->get('category');

		//换页时保存查询条件
		$para= [];
		$para['category'] = $categoryName;

		//组装查询语句
		$whereStr = "1=1";
		if($categoryName != ''){
			$whereStr = $whereStr." and category =".$categoryName;
		}

		$category = Pic::find()
			->where($whereStr);
		//分页
		$pages = new Pagination([
			'totalCount' =>$category->count(),
			'pageSize' => Common::PAGESIZE
		]);
		$models = $category
			->offset($pages->offset)
			->limit($pages->limit)
			->all();

		//字典项进行转化
		$dictItem = Dictitem::find()
			->where(['dictCode' => 'DICT_PIC_CATEGORY'])
			->all();
		foreach($models as $key => $data){
			foreach($dictItem as $index => $value){
				if($data->category == $value->dictItemCode){
					$models[$key]->category = $value->dictItemName;
				}
			}
		}
		return $this->render('listall',[
			'pics' => $models,
			'pages' => $pages,
			'para' => $para,
		]);
	}

	/**
	 * 根据ID查询一个商品类别的信息
	 * @return string
	 */
	public function actionFindOne(){

		$id = Yii::$app->request->get('id');
		$action = Yii::$app->request->get('action');

		$model = Pic::findOne($id);

		//如果是详情页
		if($action == 'detail')
		{
			//以下是现实对模型中的字典项进行转化
			$dictItem = Dictitem::find()
				->where(['dictCode' => 'DICT_PIC_CATEGORY'])
				->all();
			foreach($dictItem as $index => $value){
				if($model->category == $value->dictItemCode){
					$model->category = $value->dictItemName;
				}
			}
			//到此处截止
			return $this->render('detail',[
				'pic' => $model
			]);

		} elseif($action == 'update')//如果是修改页
		{
			return $this->render('update',[
				'pic' => $model
			]);
		}else{
			return false;
		}

	}

	/**
	 * 删除一条记录
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteOne(){

		$id = Yii::$app->request->post('id');
		$pic = Pic::findOne($id);
		$picUrl = $pic->url;
		if($pic->delete()){
			if(is_file($picUrl)){
				unlink($picUrl);
			}
			return 'success';
		}else{
			return false;
		}
	}

	/**
	 * 删除多条记录
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteMore(){

		$ids = Yii::$app->request->post('ids');
		$ids_array = explode('-',$ids);
		foreach($ids_array as $key => $value){
			$pic = Pic::findOne($value);
			$picUrl = $pic->url;
			$pic->delete();
			if(is_file($picUrl)){
				unlink($picUrl);
			}
		}
		return 'success';

	}

	/**
	 * 修改一条记录并保存到数据库
	 * @return string|void
	 */
	public function actionUpdateOne(){
		$id = Yii::$app->request->post('id');
		$pic = Pic::findOne($id);
		$picUrl = $pic->url;
		$pic->category = Yii::$app->request->post('category');
		$pic->url = Yii::$app->request->post('url');
		if($pic->save()){
			if(is_file($picUrl)){
				unlink($picUrl);
			}
			return "success";
		}else{
			return false;
		}
	}

	/**
	 * 以接收的category查询出记录，以json格式返回
	 * @return string
	 */
	public function actionAjax(){
		$category = Yii::$app->request->post('category');
		$pics = Pic::find()
			->where('category = :category',[':category'=>$category])
			->all();
		return Json::encode($pics);
	}
}