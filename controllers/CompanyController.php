<?php

namespace app\controllers;

use app\models\Admin;
use app\models\AdminRole;
use yii;
use yii\web\Controller;
use app\models\Company;
use app\models\Dictitem;
use yii\data\Pagination;
use app\common\Common;
use yii\helpers\Json;

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
	    $companyId = Common::create40ID();
        $company->id = $companyId;
        $company->name = Yii::$app->request->post('name');
        $company->introduction = Yii::$app->request->post('introduction');
        $company->tel = Yii::$app->request->post('tel');
        $company->address = Yii::$app->request->post('address');
        $company->corporate = Yii::$app->request->post('corporate');
        $company->logoUrl = Yii::$app->request->post('logoUrl');
        $company->sources = Yii::$app->request->post('sources');
        $company->webSite = Yii::$app->request->post('webSite');
        $company->category = Yii::$app->request->post('category');
        $company->datetime = date('Y-m-d H:m:s');

	    $admin = new Admin();//将管理员添加进去
	    $adminId = Common::create40ID();
	    $admin->id = $adminId;
	    $admin->username = Yii::$app->request->post('username');
	    $admin->password = Common::hashMD5(Yii::$app->request->post('password'));
	    $admin->state = '1';
	    $admin->companyId = $companyId;
	    $admin->companyName = Yii::$app->request->post('name');
        $admin->created_at = date('Y-m-d H:m:s');

	    $adminRole = new AdminRole();//为管理员添加角色
	    $adminRole->id = Common::create40ID();
	    $adminRole->userId = $adminId;
	    $adminRole->roleId = 'zsyj58fc5c7c2cc769zsyj43032473';//企业管理员ID
        if($company->save()&&$admin->save()&&$adminRole->save()){
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
        $companyId = Yii::$app->session['companyId'];
        if($companyId == 'admin'||$companyId == 'all'){
            $type = '1';
        }else{
            $type = '0';
        }
        $id = Yii::$app->request->get('id');
        $company = Company::findOne($id);
        $category = Dictitem::find()->where(['dictCode'=>'DICT_COMPANY_CATEGORY'])->all();
        return $this->render('edit',[
            'company'=>$company,
            'category'=>$category,
            'type'=>$type,
        ]);
    }

    /**
     * @return string
     * 修改一条记录
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $logoUrl = Yii::$app->request->post('logoUrl');
        $company = Company::findOne($id);
        if($company->logoUrl !== $logoUrl&&$company->logoUrl != '' &&$logoUrl !=''&&file_exists($company->logoUrl)){
            unlink($company->logoUrl );
        }
        if($logoUrl != '') {
            $company->logoUrl = $logoUrl;
        }
        $company->name = Yii::$app->request->post('name');
        $company->address = Yii::$app->request->post('address');
        $company->tel = Yii::$app->request->post('tel');
        $company->corporate = Yii::$app->request->post('corporate');
        $company->introduction = Yii::$app->request->post('introduction');
        $company->sources = Yii::$app->request->post('sources');
        $company->webSite = Yii::$app->request->post('webSite');
        $company->category = Yii::$app->request->post('category');
        $company->datetime = date('Y-m-d H:m:s');

        if($company->save()) {
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * @throws \Exception
     * 删除一条记录
     */
    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $company = Company::findOne($id);
        if($company->logoUrl != ''&&file_exists($company->logoUrl)) {
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
            if($company['logoUrl'] != ''&&file_exists($company['logoUrl'])) {
                unlink($company['logoUrl']);
            }
            Company::deleteall('id=:id',[':id'=>$data]);
        }
        return "success";
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
                $fileArg = Common::upload($_FILES,true,false,'company_company',2048000);
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
        $companyId = Yii::$app->session['companyId'];
        if($companyId == 'admin'||$companyId == 'all') {
            $id = Yii::$app->request->get('id');
            $company = Company::findOne($id);
            $category = Dictitem::find()->where(['dictCode' => 'DICT_COMPANY_CATEGORY'])->all();
            foreach ($category as $index => $value) {
                if ($company->category == $value->dictItemCode) {
                    $company->category = $value->dictItemName;
                }
            }
            return $this->render('detail', [
                'company' => $company,
                'type'=>1
            ]);
        }else{
            $id = $companyId;
            $company = Company::findOne($id);
            $category = Dictitem::find()->where(['dictCode' => 'DICT_COMPANY_CATEGORY'])->all();
            foreach ($category as $index => $value) {
                if ($company->category == $value->dictItemCode) {
                    $company->category = $value->dictItemName;
                }
            }
            return $this->render('detail', [
                'company' => $company,
                'type'=>0,
            ]);
        }
    }

    /**
     * 根据企业名称查询企业
     * @return string
     */
    public function actionFindByAttri(){
        $name = Yii::$app->request->get('name');
        $id = Yii::$app->session['companyId'];

        $para = [];
        $para['name'] = $name;

        if($id == 'admin'||$id == 'all'){
            $whereStr = '1=1';
        }else {
            $whereStr = 'id="' . $id . '"';
        }
        if($name != ''){
            $whereStr = $whereStr . " and name like '%" . $name . "%'" ;
        }

        $companys = Company::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $companys->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $companys->offset($page->offset)->limit($page->limit)->orderBy(['datetime'=>SORT_DESC])->all();

        return $this->render('listall',[
            'companys' => $models,
            'pages' => $page,
            'para' => $para,
        ]);
    }

	/**
	 * 企业接口
	 * @return string
	 */
	public function actionCompany(){
        $type = Yii::$app->request->post('newsType');
        $type = $type-1;
        $page = Yii::$app->request->post('page');
        if($type == -1){
            $query = Company::find()
                ->count();
        }else{
            $query = Company::find()
                ->where('category=:category', [':category' => $type])
                ->count();
        }
        $pagination = new Pagination([
            'page' => $page,
            'defaultPageSize' => 9,
            'validatePage' => false,
            'totalCount' => $query,
        ]);
        if($type == -1) {
            $company = Company::find()
                ->select('name,category,id,logoUrl')
                ->orderBy(['datetime' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        }else{
            $company = Company::find()
                ->select('name,category,id,logoUrl')
                ->where('category=:category', [':category' => $type])
                ->orderBy(['datetime' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }
        //企业分类的字典反转
        $category = Dictitem::find()->where(['dictCode' => 'DICT_COMPANY_CATEGORY'])->all();
        foreach($company as $key=>$data) {
            foreach ($category as $index => $value) {
                if ($data->category == $value->dictItemCode) {
                    $company[$key]->category = $value->dictItemName;
                }
            }
        }
        $para = [];
        $para['company'] = Json::encode($company);
        $para['page'] = $page;
        $para['pageSize'] = $pagination->defaultPageSize;
        $para['totalCount'] = $pagination->totalCount;
        return Json::encode($para);
	}
	/**
	 * 企业分类接口
	 * @return string
	 */
	public function actionDict(){
		$dictitems = Dictitem::find()
			->where([
				'state' => '1',
				'dictCode' => 'DICT_COMPANY_CATEGORY',
			])
			->orderBy('orderBy')
			->all();
		return Json::encode($dictitems);
	}
    /**
     * 首页4个企业的接口
     * @return string
     */
    public function actionCompanyIndex(){
        $company = Company::find()
            ->orderBy(['count'=>SORT_DESC])
            ->limit(4)
            ->all();
        return Json::encode($company);
    }

	/**
	 * 3个热点企业接口
	 * @return string
	 */
	public function actionHotCompany(){
		$company = Company::find()
			->orderBy(['count'=>SORT_DESC])
			->limit(3)
			->all();
		return Json::encode($company);
	}
}