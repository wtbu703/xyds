<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\CompanyRecruit;
use yii\data\Pagination;
use app\common\Common;

class CompanyRecruitController extends Controller{
    public $enableCsrfValidation = false;

    /**
     * @return string
     * 打开招聘信息管理页面
     */
    public function actionList(){
        return $this->render('list');
    }

    /**
     * @return string
     * 打开添加招聘信息页面
     */
    public function actionAdd(){
        return $this->render('add');
    }

    /**
     * @return string
     * 添加一条招聘信息
     */
    public function actionAddOne(){
        $companyRecruit = new CompanyRecruit();
        $companyRecruit->id = Common::create40ID();
        $companyRecruit->companyId = Yii::$app->request->post('companyId');
        $companyRecruit->position = Yii::$app->request->post('position');
        $companyRecruit->demand = Yii::$app->request->post('demand');
        $companyRecruit->mobile = Yii::$app->request->post('mobile');
        $companyRecruit->tel = Yii::$app->request->post('tel');
        $companyRecruit->email = Yii::$app->request->post('email');
        $companyRecruit->contacts = Yii::$app->request->post('contacts');

        if($companyRecruit->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 查询多条招聘信息
     */
    public function actionFindByAttri(){
        $position = Yii::$app->request->get('position');

        $para = [];
        $para['position'] = $position;

        $whereStr = '1=1';
        if($position != ''){
            $whereStr = $whereStr . " and position like '%" . $position ."%'";
        }
        $companyRecruit = CompanyRecruit::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $companyRecruit->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $companyRecruit->offset($page->offset)->limit($page->limit)->all();

        return $this->render('listall',[
            'companyRecruit'=>$models,
            'pages' => $page,
            'para' => $para,
        ]);
    }

    /**
     * @return string
     * 打开招聘信息修改页面
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $companyRecruit = CompanyRecruit::findOne($id);
        return $this->render('edit',[
            'companyRecruit'=>$companyRecruit,
        ]);
    }

    /**
     * @return string
     * 修改一条记录
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $companyRecruit = CompanyRecruit::findOne($id);
        $companyRecruit->companyId = Yii::$app->request->post('companyId');
        $companyRecruit->position = Yii::$app->request->post('position');
        $companyRecruit->demand = Yii::$app->request->post('demand');
        $companyRecruit->mobile = Yii::$app->request->post('mobile');
        $companyRecruit->tel = Yii::$app->request->post('tel');
        $companyRecruit->email = Yii::$app->request->post('email');
        $companyRecruit->contacts = Yii::$app->request->post('contacts');

        if($companyRecruit->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除一条招聘信息
     */
    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $companyRecruit = CompanyRecruit::findOne($id);

        if($companyRecruit->delete()){
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
            CompanyRecruit::deleteall('id=:id',[':id'=>$data]);
        }
    }

    /**
     * @return string
     * 打开企业招聘信息详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $companyRecruit = CompanyRecruit::findOne($id);
        return $this->render('detail',[
            'companyRecruit'=>$companyRecruit
        ]);
    }
}



