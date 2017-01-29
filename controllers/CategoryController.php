<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/29
 * Time: 19:19
 */
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Category;
use app\models\CategoryFull;
use yii\data\Pagination;
use app\common\Common;
use app\models\Dictitem;

class CategoryController extends Controller{

	public $enableCsrfValidation = false;

	public function actionIndex(){
		return $this->render('index');
	}

	public function actionAdd(){
		return $this->render('add');
	}

	/**
	 * 检查一条记录是否存在
	 * @return string
	 */
	public function actionCheckOne(){

		$categoryCode = Yii::$app->request->get('categoryCode');
		$model = Category::find()
			->where(['categoryCode' => $categoryCode])
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

		$category = new Category();
		$category->id = Common::create40ID();
		$category->categoryCode = Yii::$app->request->post('categoryCode');
		$category->categoryName = Yii::$app->request->post('categoryName');
		$category->intro = Yii::$app->request->post('intro');
		$category->state = '1';

		if($category->save()){
			$categoryFullOrders = Yii::$app->request->post('categoryFullOrders');
			$categoryFullNames = Yii::$app->request->post('categoryFullNames');
			$buyCodes = Yii::$app->request->post('buyCodes');
			$sellCodes = Yii::$app->request->post('sellCodes');
			if(is_null($categoryFullOrders)||is_null($categoryFullNames)||is_null($buyCodes)||is_null($sellCodes)){
				//return;
			}else{

				$categoryFullOrders_arry = explode('-',$categoryFullOrders);
				$categoryFullNames_arry = explode('-',$categoryFullNames);
				$buyCodes_arry = explode('-',$buyCodes);
				$sellCodes_arry = explode('-',$sellCodes);

				foreach($categoryFullOrders_arry as $key => $data)
				{
					$categoryFull = new CategoryFull();
					$categoryFull->id = Common::create40ID();
					$categoryFull->categoryCode = $category->categoryCode;
					$categoryFull->categoryFullName = $categoryFullNames_arry[$key];
					$categoryFull->buyCode = $buyCodes_arry[$key];
					$categoryFull->sellCode = $sellCodes_arry[$key];
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
		$categoryName = Yii::$app->request->get('categoryName');
		$state = Yii::$app->request->get('state');

		//换页时保存查询条件
		$para= [];
		$para['categoryName'] = $categoryName;
		$para['state'] = $state;

		//组装查询语句
		$whereStr = "1=1";
		if($categoryName != ''){
			$whereStr = $whereStr." and categoryName like '%".$categoryName."%'";
		}
		if($state != ''){
			$whereStr = $whereStr." and state=".$state;
		}

		$category = Category::find()
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

		$categoryCode = Yii::$app->request->get('categoryCode');
		$action = Yii::$app->request->get('action');

		$category = Category::find()
			->where(['categoryCode' => $categoryCode])
			->one();
		$categoryFulls = CategoryFull::find()
			->where(['categoryCode' => $categoryCode])
			->all();
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
		//如果是详情页
		if($action == 'detail')
		{
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

		if(CategoryFull::findOne(Yii::$app->request->post('id'))->delete()){
			return "success";
		}else{
			return false;
		}
	}

	/**
	 * 修改一条记录并保存到数据库
	 * @return string|void
	 */
	public function actionUpdateOne(){

		$categoryCode = Yii::$app->request->post('categoryCode');
		$category = Category::find()
			->where(['categoryCode' => $categoryCode])
			->one();
		$category->categoryName = Yii::$app->request->post('categoryName');
		$category->intro = Yii::$app->request->post('intro');
		$category->state = Yii::$app->request->post('state');

		if($category->save()){
			$categoryFullOrders = Yii::$app->request->post('categoryFullOrders');
			$categoryFullNames = Yii::$app->request->post('categoryFullNames');
			$buyCodes = Yii::$app->request->post('buyCodes');
			$sellCodes = Yii::$app->request->post('sellCodes');
			if(is_null($categoryFullOrders)||is_null($categoryFullNames)||is_null($buyCodes)||is_null($sellCodes)){
				//return;
			}else{
				$ids = Yii::$app->request->post('ids');
				$categoryFullOrders_arry = explode('-',$categoryFullOrders);
				$categoryFullNames_arry = explode('-',$categoryFullNames);
				$buyCodes_arry = explode('-',$buyCodes);
				$sellCodes_arry = explode('-',$sellCodes);
				$ids_arry = explode('-',$ids);
				foreach($categoryFullOrders_arry as $key => $data)
				{

					if($ids_arry[$key] == '1'){
						$categoryFull = new CategoryFull();
						$categoryFull->id = Common::create40ID();
					}else{
						$categoryFull = CategoryFull::findOne($ids_arry[$key]);
					}

					$categoryFull->categoryCode = $category->categoryCode;
					$categoryFull->categoryFullName = $categoryFullNames_arry[$key];
					$categoryFull->buyCode = $buyCodes_arry[$key];
					$categoryFull->sellCode = $sellCodes_arry[$key];
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
}