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
use app\models\Picitem;
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
	 * 检查一条记录是否存在
	 * @return string
	 */
	public function actionCheckOne(){

		$categoryCode = Yii::$app->request->get('categoryCode');
		$model = Pic::find()
			->where(['picCode' => $categoryCode])
			->one();
		if(is_null($model)){
			return '';
		}else{
			return 'exist';
		}
	}

	/**
	 * 插入一条记录
	 * @return string|void
	 */
	public function actionAddOne(){

		$category = new Pic();
		$category->id = Common::create40ID();
		$category->picCode = Yii::$app->request->post('picCode');
		$category->picName = Yii::$app->request->post('picName');
		$category->intro = Yii::$app->request->post('intro');
		$category->state = '1';

		if($category->save()){
			$categoryFullOrders = Yii::$app->request->post('categoryFullOrders');
			$categoryFullNames = Yii::$app->request->post('picUrls');
			if(is_null($categoryFullOrders)||is_null($categoryFullNames)){
				//return;
			}else{

				$categoryFullOrders_arry = explode('-',$categoryFullOrders);
				$categoryFullNames_arry = explode(';',$categoryFullNames);

				foreach($categoryFullOrders_arry as $key => $data)
				{
					$categoryFull = new Picitem();
					$categoryFull->id = Common::create40ID();
					$categoryFull->picCode = $category->picCode;
					$categoryFull->picUrl = $categoryFullNames_arry[$key];
					$categoryFull->orderBy = intval($data);
					$categoryFull->state = '1';
					$categoryFull->save();
				}
			}
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
		$categoryName = Yii::$app->request->get('picName');
		$state = Yii::$app->request->get('state');

		//换页时保存查询条件
		$para= [];
		$para['picName'] = $categoryName;
		$para['state'] = $state;

		//组装查询语句
		$whereStr = "1=1";
		if($categoryName != ''){
			$whereStr = $whereStr." and picName like '%".$categoryName."%'";
		}
		if($state != ''){
			$whereStr = $whereStr." and state=".$state;
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
			->where(['dictCode' => 'DICT_STATE'])
			->all();
		foreach($models as $key => $data){
			foreach($dictItem as $index => $value){
				if($data->state == $value->dictItemCode){
					$models[$key]->state = $value->dictItemName;
				}
			}
		}
		return $this->render('listall',[
			'categorys' => $models,
			'pages' => $pages,
			'para' => $para,
		]);
	}

	/**
	 * 根据ID查询一个商品类别的信息
	 * @return string
	 */
	public function actionFindOne(){

		$categoryCode = Yii::$app->request->get('picCode');
		$action = Yii::$app->request->get('action');

		$category = Pic::find()
			->where(['picCode' => $categoryCode])
			->one();
		$categoryFulls = Picitem::find()
			->where(['picCode' => $categoryCode])
			->orderBy('orderBy')
			->all();

		//如果是详情页
		if($action == 'detail')
		{
			//以下是现实对模型中的字典项进行转化
			$dictItem = Dictitem::find()
				->where(['dictCode' => 'DICT_STATE'])
				->all();
			foreach($dictItem as $index => $value){
				if($category->state == $value->dictItemCode){
					$category->state = $value->dictItemName;
				}
			}
			//到此处截止
			return $this->render('detail',[
				'category' => $category,
				'categoryFulls' => $categoryFulls,
			]);

		} elseif($action == 'update')//如果是修改页
		{
			return $this->render('update',[
				'category' => $category,
				'categoryFulls' => $categoryFulls,
			]);
		}else{
			return false;
		}

	}

	/**
	 * 删除一条具体类别记录
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteOneItem(){

		$picitem = Picitem::findOne(Yii::$app->request->post('id'));
		$picUrl = $picitem->picUrl;
		if($picitem->delete()){
			if(!is_null($picUrl)){
				unlink($picUrl);//删除文件
			}
			return "success";
		}else{
			return false;
		}
	}

	/**
	 * 删除一条商品大类，包括其下的具体类别
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteOne(){

		$categoryCode = Yii::$app->request->post('picCode');
		Pic::find()
			->where(['picCode' => $categoryCode])
			->one()
			->delete();
		$picitem = Picitem::find()
			->where('picCode = :categoryCode',[':categoryCode'=>$categoryCode])
			->all();
		foreach($picitem as $key => $value){
			$picUrl = $value->picUrl;
			if(!is_null($picUrl)){
				unlink($picUrl);//删除文件
			}
			$value->delete();
		}
		return 'success';

	}

	/**
	 * 删除多条商品大类记录
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteMore(){

		$categoryCodes = Yii::$app->request->post('picCodes');
		$categoryCodes_array = explode('-',$categoryCodes);
		foreach($categoryCodes_array as $index => $data){
			$picitems = Picitem::find()
				->where('picCode = :categoryCode',[':categoryCode'=>$data])
				->all();
			foreach($picitems as $key => $value){
				$picUrl = $value->picUrl;
				if(!is_null($picUrl)){
					unlink($picUrl);//删除文件
				}
			}
			Pic::find()
				->where(['picCode' => $data])
				->one()
				->delete();
		}
		return 'success';

	}

	/**
	 * 修改一条记录并保存到数据库
	 * @return string|void
	 */
	public function actionUpdateOne(){

		$categoryCode = Yii::$app->request->post('categoryCode');
		//$categoryCode = 'LUNBO';
		$category = Pic::find()
			->where(['picCode' => $categoryCode])
			->one();
		$category->picName = Yii::$app->request->post('picName');
		$category->intro = Yii::$app->request->post('intro');
		$category->state = Yii::$app->request->post('state');

		if($category->save()){//pic保存
			$orders = Yii::$app->request->post('orders');
			$picUrls = Yii::$app->request->post('picUrls');
			if(is_null($orders)||is_null($picUrls)||($orders=='')||($picUrls=='')){//如果传来的是空值
				//return;
			}else{
				$ids = Yii::$app->request->post('ids');
				$orders_arry = explode('-',$orders);
				$picUrls_arry = explode(';',$picUrls);
				$ids_arry = explode('-',$ids);
				foreach($orders_arry as $key => $data)
				{

					if($ids_arry[$key] == '1'){
						$picitem = new Picitem();
						$picitem->id = Common::create40ID();
						if(!is_null($picUrls_arry[$key])){//如果修改后不为空值
							$picitem->picUrl = $picUrls_arry[$key];//覆盖原值
						}
					}else{
						$picitem = Picitem::findOne($ids_arry[$key]);
						if(($picUrls_arry[$key] != '')||(!is_null($picUrls_arry[$key]))){//如果修改后不为空值
							if(($picitem->picUrl != '')||(!is_null($picitem->picUrl))){//如果原值不为空
								if($picitem->picUrl != $picUrls_arry[$key]){//如果新值和旧值不相等
									if(file_exists($picitem->picUrl)){//如果原文件存在
										if(file_exists($picUrls_arry[$key])){//如果新文件存在
											$picitem->picUrl = $picUrls_arry[$key];//覆盖原值
											unlink($picitem->picUrl);//删除原文件
										}
									}
								}
							}
						}
					}

					$picitem->picCode = $category->picCode;

					if(!is_null($data)){
						$picitem->orderBy = intval($data);
					}
					$picitem->state = '1';
					$picitem->save();
				}
			}
			return 'success';
		}else{
			return false;
		}
	}

	/**
	 * 以接收的code查询出item记录，以json格式返回
	 * @return string
	 */
	public function actionAjax(){
		$code = Yii::$app->request->post('code');
		$picitem = Picitem::find()->where('picCode = :picCode',[':picCode'=>$code])->all();
		return Json::encode($picitem);
	}
}