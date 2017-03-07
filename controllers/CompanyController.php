<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Company;
use yii\data\Pagination;
use app\common\Common;

class CompanyController extends Controller{
    public $enableCsrfValidation = false;

    /**
     * 显示企业管理页面
     * @return string
     */
    public function actionList(){
       return $this->render('list');
    }

    /**
     * @return string
     * 打开添加企业页面
     */
    public function actionAdd(){
        return $this->render('add');
    }

    /**
     * @return string
     * 添加一个企业
     */
    public function actionAddOne(){
        $company = new Company();
        $company->id = Common::create40ID();
        $company->name = Yii::$app->request->post('name');
        $company->introduction = Yii::$app->request->post('introduction');
        $company->tel = Yii::$app->request->post('tel');
        $company->address = Yii::$app->request->post('address');
        $company->corporate = Yii::$app->request->post('corporate');
        $company->logoUrl = Yii::$app->request->post('logoUrl');

        if($company->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 打开企业修改页面
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $company = Company::findOne($id);
        return $this->render('edit',[
            'company'=>$company,
        ]);
    }

    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $logoUrl = Yii::$app->request->post('logoUrl');
        $company = Company::findOne($id);
        if($company->logoUrl !== $logoUrl&&$company->logoUrl != '' &&$logoUrl !=''){
            unlink($company->logoUrl );
        }
        $company->logoUrl = $logoUrl;
        $company->name = Yii::$app->request->post('name');
        $company->address = Yii::$app->request->post('address');
        $company->tel = Yii::$app->request->post('tel');
        $company->corporate = Yii::$app->request->post('corporate');
        $company->introduction = Yii::$app->request->post('introduction');

        if($company->save()) {
            return "success";
        }else{
            return "fail";
        }
    }

    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $company = Company::findOne($id);
        if($company->logoUrl != '') {
            unlink($company->logoUrl);
        }
        if($company->delete()) {
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 根据id删除多条记录
     */
    public function actionDeleteMore(){
        $ids = Yii::$app->request->post('ids');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key=>$data){
            $company = Company::findOne($data);
            if($company->logoUrl != '') {
                unlink($company->logoUrl);
            }
            Company::deleteall('id=:id',[':id'=>$data]);
        }
        return "success";
    }


    /*
     * 上传图片
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

    /**
     * @return string
     * 打开企业的详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $company = Company::findOne($id);
        return $this->render('detail',[
            'company'=>$company
        ]);
    }

    /**
     * 根据企业名称查询企业
     * @return string
     */
    public function actionFindByAttri(){
        $name = Yii::$app->request->get('name');

        $para = [];
        $para['name'] = $name;

        $whereStr = '1=1';
        if($name != ''){
            $whereStr = $whereStr . " and name like '%" . $name . "%'" ;
        }

        $companys = Company::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $companys->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $companys->offset($page->offset)->limit($page->limit)->all();

        return $this->render('listall',[
            'companys' => $models,
            'pages' => $page,
            'para' => $para,
        ]);
    }

}