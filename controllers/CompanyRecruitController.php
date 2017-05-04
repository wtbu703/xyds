<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\CompanyRecruit;
use yii\data\Pagination;
use app\common\Common;
use yii\helpers\Json;
use yii\db\Query;

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
        $companyRecruit->companyId = Yii::$app->session['companyId'];
        $companyRecruit->position = Yii::$app->request->post('position');
        $companyRecruit->demand = Yii::$app->request->post('demand');
        $companyRecruit->mobile = Yii::$app->request->post('mobile');
        $companyRecruit->tel = Yii::$app->request->post('tel');
        $companyRecruit->email = Yii::$app->request->post('email');
        $companyRecruit->contacts = Yii::$app->request->post('contacts');
        $companyRecruit->workPlace = Yii::$app->request->post('workPlace');
        $companyRecruit->record = Yii::$app->request->post('record');
        $companyRecruit->salary = Yii::$app->request->post('salary');
        $companyRecruit->contacts = Yii::$app->request->post('contacts');
        $companyRecruit->datetime = date('Y-m-d H:i:s');

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
        $companyId = Yii::$app->session['companyId'];

        $para = [];
        $para['position'] = $position;

        $whereStr = 'companyId = "' . $companyId . '"';
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
        $companyRecruit->companyId = Yii::$app->session['companyId'];
        $companyRecruit->position = Yii::$app->request->post('position');
        $companyRecruit->demand = Yii::$app->request->post('demand');
        $companyRecruit->mobile = Yii::$app->request->post('mobile');
        $companyRecruit->tel = Yii::$app->request->post('tel');
        $companyRecruit->email = Yii::$app->request->post('email');
        $companyRecruit->contacts = Yii::$app->request->post('contacts');
        $companyRecruit->workPlace = Yii::$app->request->post('workPlace');
        $companyRecruit->record = Yii::$app->request->post('record');
        $companyRecruit->salary = Yii::$app->request->post('salary');
        $companyRecruit->contacts = Yii::$app->request->post('contacts');
        $companyRecruit->datetime = date('Y-m-d H:i:s');

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
            CompanyRecruit::deleteAll('id=:id',[':id'=>$data]);
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

    /**
     * @return string
     * 企业招聘的接口
     */
    public function actionCompanyRecruit(){
	    $companyId = Yii::$app->request->post('companyId');
	    $companyRecruit = CompanyRecruit::find()
		    ->where('companyId = :companyId',[":companyId" => $companyId])
		    ->orderBy(['datetime'=>SORT_DESC])
		    ->all();
        return Json::encode($companyRecruit);
    }


    /**
     * @return string
     * 10个职位和介绍
     */
    public function actionPositions(){
        $cat = Yii::$app->request->post('cat');

            if ($cat == 0) {
                $term = 'datetime';
            } else if ($cat == 1) {
                $term = 'datetime';
            } else if ($cat == 2) {
                $term = 'count';
            }
            $query = new Query();
            $companyRecruit = $query->select('a.id as id,b.id as companyId,b.name as companyName,a.position as position,a.demand as demand,a.salary as salary,a.exp as exp,a.workPlace as workPlace,a.record as record,a.count as count,a.datetime as datetime')
                ->from('companyRecruit a')
                ->orderBy([$term => SORT_DESC])
                ->leftJoin('company b', 'a.companyId = b.id')
                ->all();

        return Json::encode($companyRecruit);
    }

    /**
     * @return string
     * 根据热门职位查询招聘信息
     */
    public function actionSearch(){
        $index = Yii::$app->request->post('index');
        $searchValue = Yii::$app->request->post('searchValue');
        if($index == 0){
            $sear = 'demand';
        }else if($index == 1){
            $sear = 'position';
        }else if($index == 2){
            $sear = 'companyName';
        }
        $whereStr = '';
        $whereStr = $whereStr . " $sear like '%" . $searchValue ."%'";
        $query = new Query();
        $companyRecruit = $query->select('a.id as id,b.id as companyId,b.name as companyName,a.position as position,a.demand as demand,a.salary as salary,a.exp as exp,a.workPlace as workPlace,a.record as record,a.count as count,a.datetime as datetime')
            ->from('companyRecruit a')
            ->where($whereStr)
            ->orderBy(['datetime' =>SORT_DESC])
            ->leftJoin('company b','a.companyId = b.id')
            ->all();
        return Json::encode($companyRecruit);
    }
}



