<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Userorder;
use app\common\Common;
use yii\data\Pagination;

/**
 * Class OrderController
 * @package app\controllers
 */
class OrderController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

	/**
	 * @return string
	 */
	public function actionList()
    {
        return $this->render('list');
    }

	/**
	 * @return string
	 */
	public function actionAdd(){
        return $this->render('add');
    }

	/**
	 * @return string
	 */
	public function actionAddOne(){

        $Userorder = new Userorder();
        $Userorder->id = Common::generateID();
        $Userorder->orderNo = Common::generateOrderCode();
        $Userorder->userID = Yii::$app->request->post('userID');
        $Userorder->name = Yii::$app->request->post('name');
        $Userorder->mobile = Yii::$app->request->post('mobile');
        $Userorder->postCode = Yii::$app->request->post('postCode');
        $Userorder->address = Yii::$app->request->post('address');
        $Userorder->cost = Yii::$app->request->post('cost');
        $Userorder->orderState = Yii::$app->request->post('orderState');
        $Userorder->dateTime = date("Y-m-d H:i:s");

        if($Userorder->save()){
            return "success";
        }else{
            return "fail";
        }
    }

	/**
	 * @return string
	 */
	public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $userorder = Userorder::findOne($id);

        return $this->render('detail',[
            'userorder'=>$userorder
        ]);
    }

	/**
	 * @return string
	 */
	public function actionFindByAttri(){

        $orderNo = Yii::$app->request->get('orderNo');
        $name = Yii::$app->request->get('name');
        $orderState = Yii::$app->request->get('orderState');
        $orderdateTime_1 = Yii::$app->request->get('orderdateTime_1');
        $orderdateTime_2 = Yii::$app->request->get('orderdateTime_2');

        $para = [];
        $para['orderNo'] = $orderNo;
        $para['name'] = $name;
        $para['orderState'] = $orderState;
        $para['orderdateTime_1'] = $orderdateTime_1;
        $para['orderdateTime_2'] = $orderdateTime_2;

        $whereStr = '1=1';
        if($orderNo != ''){
            $whereStr = $whereStr . " and orderNo like '%" . $orderNo . "%'";
        }
        if($name != ''){
            $whereStr = $whereStr . " and name like '%" . $name . "%'";
        }
        if($orderState != ''){
            $whereStr = $whereStr . " and orderState=" . $orderState;
        }
        if($orderdateTime_1 != ''){
            $whereStr = $whereStr." and dateTime >= '".$orderdateTime_1."%'";
        }
        if($orderdateTime_2 != ''){
            $whereStr = $whereStr." and dateTime <= '".$orderdateTime_2."%'";
        }
        $userorders = Userorder::find()->where($whereStr);
        $pages = new Pagination(['totalCount' => $userorders->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $userorders->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('listall', [
            'userorders' => $models,
            'pages' => $pages,
            'para' => $para,
        ]);
    }

	/**
	 * @return string
	 */
	public function actionUpdate(){

        $id = Yii::$app->request->get('id');
        $userorder = Userorder::findOne($id);
        return $this->render('edit',[
            'userorder' => $userorder,
        ]);
    }

	/**
	 * @return string
	 */
	public function actionUpdateOne(){

        $id = Yii::$app->request->post('id');
        $userorder = Userorder::findOne($id);
        $userorder->orderState = Yii::$app->request->post('orderState');
        $userorder->address = Yii::$app->request->post('address');
        $userorder->postCode = Yii::$app->request->post('postCode');
        $userorder->mobile = Yii::$app->request->post('mobile');
        $userorder->cost = Yii::$app->request->post('cost');

        if($userorder->save()) {
            return "success";
        }else{
            return "fail";
        }
    }

	/**
	 * @return string
	 * @throws \Exception
	 */
	public function actionDeleteOne(){
        $id = Yii::$app->request->post("id");
        $userorder = Userorder::findOne($id);
        if($userorder->delete()){
            return "success";
        }else{
            return "fail";
        }
    }

	/**
	 * @return string
	 */
	public function actionDeleteMore(){

        $ids = Yii::$app->request->post('ids');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key => $data){
            Userorder::deleteAll('id= :id',[':id'=>$data]);
        }
        return 'success';
    }
}

