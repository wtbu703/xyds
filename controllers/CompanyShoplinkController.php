<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\CompanyShoplink;
use app\models\Dictitem;
use yii\data\Pagination;
use app\common\Common;

class CompanyShoplinkController extends Controller{
    public $enableCsrfValidation = false;

    /**
     * @return mixed
     * 打开网店链接管理页面
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * @return string
     * 打开添加网店页面
     */
    public function actionAdd(){
        return $this->render('add');
    }

    /**
     * @return string
     * 添加一条记录
     */
    public function actionAddOne(){
        $companyShoplink = new CompanyShoplink();
        $companyShoplink->id = Common::create40ID();
        $companyShoplink->companyId = Yii::$app->request->post('companyId');
        $companyShoplink->shopName = Yii::$app->request->post('shopName');
        $companyShoplink->shopLink = Yii::$app->request->post('shopLink');
        $companyShoplink->platform = Yii::$app->request->post('platform');
        if($companyShoplink->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 根据网店名称查询多条记录
     */
    public function actionFindByAttri()
    {
        $shopName = Yii::$app->request->get('shopName');
        $platform = Yii::$app->request->get('platform');

        $para = [];
        $para['shopName'] = $shopName;
        $para['platform'] = $platform;

        $whereStr = '1=1';
        if ($shopName != '') {
            $whereStr = $whereStr . " and shopName like '%" . $shopName . "%'";
        }
        if ($platform != '') {
            $whereStr = $whereStr . " and platform like '%" . $platform . "%'";
        }
        $companyShoplink = CompanyShoplink::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $companyShoplink->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $companyShoplink->offset($page->offset)->limit($page->limit)->all();

        //字典反转
        $platform = Dictitem::find()->where(['dictCode'=>'DICT_PLATFORM'])->all();
        foreach($models as $key=>$data) {
            foreach ($platform as $index => $value) {
                if ($data->platform == $value->dictItemCode) {
                    $models[$key]->platform = $value->dictItemName;
                }
            }
        }

        return $this->render('listall', [
            'companyShoplink' => $models,
            'pages' => $page,
            'para' => $para,
        ]);
    }

    /**
     * @return string
     * 打开修改产品页面
     */
    public  function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $companyShoplink = CompanyShoplink::findOne($id);
        $platform = Dictitem::find()->where(['dictCode' => 'DICT_PLATFORM'])->all();
        return $this->render('edit',[
            'companyShoplink'=>$companyShoplink,
            'platform'=>$platform,
        ]);
    }

    /**
     * @return string
     * 修改一条记录
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $companyShoplink = CompanyShoplink::findOne($id);
        $companyShoplink->companyId = Yii::$app->request->post('companyId');
        $companyShoplink->shopName = Yii::$app->request->post('shopName');
        $companyShoplink->shopLink = Yii::$app->request->post('shopLink');
        $companyShoplink->platform = Yii::$app->request->post('platform');

        if($companyShoplink->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除一条记录
     */
    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $companyShoplink = CompanyShoplink::findOne($id);
        if($companyShoplink->delete()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除多条记录
     */
    public function actionDeleteMore(){
        $ids = Yii::$app->request->post('ids');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key=>$data){
            CompanyShoplink::deleteAll('id=:id',[':id'=>$data]);
        }
        return "success";
    }

    /**
     * @return string
     * 打开网店详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $companyShoplink = CompanyShoplink::findOne($id);
        //字典反转
        $platform = Dictitem::find()->where(['dictCode'=>'DICT_PLATFORM'])->all();
        foreach ($platform as $index => $value) {
            if ($companyShoplink->platform == $value->dictItemCode) {
                $companyShoplink->platform = $value->dictItemName;
            }
        }
        return $this->render('detail',[
            'companyShoplink'=>$companyShoplink
        ]);
    }

}