<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Userorder;
use app\common\Common;
use yii\data\Pagination;

class OrderController extends Controller
{
    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionList()
    {
        return $this->render('list');
    }

    public function actionAdd(){
        return $this->render('add');
    }

    public function actionAddOne(){

        $Userorder = new Userorder();
        $Userorder->id = Common::generateID();
        $Userorder->orderNo = Common::generateOrderCode();
        $Userorder->userID = yii::$app->request->post('userID');
        $Userorder->name = yii::$app->request->post('name');
        $Userorder->mobile = yii::$app->request->post('mobile');
        $Userorder->postCode = yii::$app->request->post('postCode');
        $Userorder->address = yii::$app->request->post('address');
        $Userorder->cost = yii::$app->request->post('cost');
        $Userorder->orderState = yii::$app->request->post('orderState');
        $Userorder->dateTime = date("Y-m-d H:i:s");

        if($Userorder->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    public function actionFindOne(){
        $id = yii::$app->request->get('id');
        $userorder = Userorder::findOne($id);

        return $this->render('detail',[
            'userorder'=>$userorder
        ]);
    }

    public function actionFindByAttri(){

        $orderNo = yii::$app->request->get('orderNo');
        $name = yii::$app->request->get('name');
        $orderState = yii::$app->request->get('orderState');
        $orderdateTime_1 = yii::$app->request->get('orderdateTime_1');
        $orderdateTime_2 = yii::$app->request->get('orderdateTime_2');

        $para = array();
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

    public function actionUpdate(){

        $id = yii::$app->request->get('id');
        $userorder = Userorder::findOne($id);
        return $this->render('edit',[
            'userorder' => $userorder,
        ]);
    }

    public function actionUpdateOne(){

        $id = yii::$app->request->post('id');
        $userorder = Userorder::findOne($id);
        $userorder->orderState = yii::$app->request->post('orderState');
        $userorder->address = yii::$app->request->post('address');
        $userorder->postCode = yii::$app->request->post('postCode');
        $userorder->mobile = yii::$app->request->post('mobile');
        $userorder->cost = yii::$app->request->post('cost');

        if($userorder->save()) {
            return "success";
        }else{
            return "fail";
        }
    }

    public function actionDeleteOne(){
        $id = Yii::$app->request->post("id");
        $userorder = Userorder::findOne($id);
        if($userorder->delete()){
            return "success";
        }else{
            return "fail";
        }
    }

    public function actionDeleteMore(){

        $ids = yii::$app->request->post('ids');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key => $data){
            Userorder::deleteall('id= :id',[':id'=>$data]);
        }
        return 'success';
    }
}

