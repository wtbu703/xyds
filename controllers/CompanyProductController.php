<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\CompanyProduct;
use app\models\Dictitem;
use yii\data\Pagination;
use app\common\Common;
use yii\helpers\Json;

class CompanyProductController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @return mixed
     * 打开产品管理页面
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * @return string
     * 打开添加产品页面
     */
    public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * @return string
     * 添加一个产品
     */
    public function actionAddOne()
    {
        $companyProduct = new CompanyProduct();
        $companyProduct->id = Common::create40ID();
        $companyProduct->companyId = Yii::$app->request->post('companyId');
        $companyProduct->name = Yii::$app->request->post('name');
        $companyProduct->introduction = Yii::$app->request->post('introduction');
        $companyProduct->price = Yii::$app->request->post('price');
        $companyProduct->stock = Yii::$app->request->post('stock');
        $companyProduct->discount = Yii::$app->request->post('discount');
        $companyProduct->state = Yii::$app->request->post('state');
        $companyProduct->thumbnailUrl = Yii::$app->request->post('thumbnailUrl');

        if ($companyProduct->save()) {
            return "success";
        } else {
            return "fail";
        }
    }

    /**
     * 根据企业名称查询企业
     * @return string
     */
    public function actionFindByAttri()
    {
        $name = Yii::$app->request->get('name');
        $state = Yii::$app->request->get('state');

        $para = [];
        $para['name'] = $name;
        $para['state'] = $state;

        $whereStr = '1=1';
        if ($name != '') {
            $whereStr = $whereStr . " and name like '%" . $name . "%'";
        }
        if ($state != '') {
            $whereStr = $whereStr . " and state like '%" . $state . "%'";
        }
        $companyProduct = CompanyProduct::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $companyProduct->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $companyProduct->offset($page->offset)->limit($page->limit)->all();

        //字典反转
        $productState = Dictitem::find()->where(['dictCode'=>'DICT_PRODUCT_STATE'])->all();
        foreach($models as $key=>$data) {
            foreach ($productState as $index => $value) {
                if ($data->state == $value->dictItemCode) {
                    $models[$key]->state = $value->dictItemName;
                }
            }
        }

        return $this->render('listall', [
            'companyProduct' => $models,
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
        $companyProduct = CompanyProduct::findOne($id);
        $productState = Dictitem::find()->where(['dictCode'=>'DICT_PRODUCT_STATE'])->all();
        return $this->render('edit',[
            'companyProduct'=>$companyProduct,
            'productState'=>$productState,
        ]);
    }

    /**
     * @return string
     * 修改一条记录
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $thumbnailUrl = Yii::$app->request->post('thumbnailUrl');
        $companyProduct = CompanyProduct::findOne($id);
        if($companyProduct->thumbnailUrl != $thumbnailUrl&&$companyProduct->thumbnailUrl !=''&&$thumbnailUrl !=''&&file_exists($companyProduct->thumbnailUrl)){
            unlink($companyProduct->thumbnailUrl);

        }
        $companyProduct->thumbnailUrl = $thumbnailUrl;
        $companyProduct->companyId = Yii::$app->request->post('companyId');
        $companyProduct->name = Yii::$app->request->post('name');
        $companyProduct->introduction = Yii::$app->request->post('introduction');
        $companyProduct->price = Yii::$app->request->post('price');
        $companyProduct->stock = Yii::$app->request->post('stock');
        $companyProduct->discount = Yii::$app->request->post('discount');
        $companyProduct->state = Yii::$app->request->post('state');

        if($companyProduct->save()){
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
        $companyProduct = CompanyProduct::findOne($id);
        if(!is_null($companyProduct->thumbnailUrl)&&file_exists($companyProduct->thumbnailUrl)){
            unlink($companyProduct->thumbnailUrl);
        }
        if($companyProduct->delete()){
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
            $companyProduct = CompanyProduct::findOne($data);
            if(!is_null($companyProduct->thumbnailUrl)&&file_exists($companyProduct->thumbnailUrl)){
                unlink($companyProduct->thumbnailUrl);
            }
            CompanyProduct::deleteAll('id=:id',[':id'=>$data]);
        }
        return "success";
    }

    /**
     * @return string
     * 打开产品详情页面
     */
    public function actionFindOne()
    {
        $id = Yii::$app->request->get('id');
        $companyProduct = CompanyProduct::findOne($id);

        //字典反转
        $productState = Dictitem::find()->where(['dictCode' => 'DICT_PRODUCT_STATE'])->all();
        foreach ($productState as $index => $value) {
            if ($companyProduct->state == $value->dictItemCode) {
                $companyProduct->state = $value->dictItemName;
            }
        }
        return $this->render('detail',[
            'companyProduct'=>$companyProduct,
        ]);
    }

    /*
     * 上传
     */
    public function actionUpload(){
        //实现上传
        if (Yii::$app->request->isPost) {
            $isThumb = Yii::$app->request->get('isThumb');
            $views = 'upload';
            if(is_null($isThumb)){
                $fileArg = Common::upload($_FILES,true,false);
            }else{
                $fileArg = Common::upload($_FILES,true,true);
                $views = 'uploads';
            }

            return $this->render($views,[
                "fileArg" => $fileArg,
                "tag" => $fileArg['tag'],
            ]);
        }
        $detail = Yii::$app->request->get('detail');
        if(is_null($detail)){
            return $this->render('upload',[
                "tag" => "empty",
                "fileArg" =>[
                    "fileSaveUrl" =>"",//上传文件保存的路径
                    "tag" => "",//当为success表示上传成功，当为error时表示文件过大或是文件类型不对
                ],
            ]);
        }else{
            return $this->render('uploads',[
                "tag" => "empty",
                "fileArg" =>[
                    "fileSaveUrl" =>"",//上传文件保存的路径
                    "tag" => "",//当为success表示上传成功，当为error时表示文件过大或是文件类型不对
                ],
            ]);
        }
    }
    public function actionCompanyProduct(){
        $companyProduct = CompanyProduct::find()->all();
        return Json::encode($companyProduct);
    }
}