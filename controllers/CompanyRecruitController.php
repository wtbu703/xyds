<?php
namespace app\controllers;

use app\models\Dictitem;
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
        $type = Yii::$app->request->get('type');
        $companyId = Yii::$app->session['companyId'];

        if($type == '0'){
            return $this->render('adminlist',[
                'companyId'=>$companyId,
                'type'=>$type,
            ]);
        }
        return $this->render('list',[
            'type'=>1,
            'companyId'=>$companyId,
        ]);
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
        $companyId = Yii::$app->session['companyId'];
        if($companyId == 'admin'||$companyId == 'all'){
            $companyRecruit = new CompanyRecruit();
            $companyRecruit->id = Common::create40ID();
            $companyRecruit->position = Yii::$app->request->post('position');
            $companyRecruit->demand = Yii::$app->request->post('demand');
            $companyRecruit->mobile = Yii::$app->request->post('mobile');
            $companyRecruit->tel = Yii::$app->request->post('tel');
            $companyRecruit->email = Yii::$app->request->post('email');
            $companyRecruit->contacts = Yii::$app->request->post('contacts');
            $companyRecruit->place = Yii::$app->request->post('place');
            $companyRecruit->workPlace = Yii::$app->request->post('workPlace');
            $companyRecruit->record = Yii::$app->request->post('record');
            $companyRecruit->salary = Yii::$app->request->post('salary');
            $companyRecruit->contacts = Yii::$app->request->post('contacts');
            $companyRecruit->exp = Yii::$app->request->post('exp');
            $companyRecruit->datetime = date('Y-m-d H:i:s');
            $companyRecruit->state = '0';
        }else{
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
            $companyRecruit->place = Yii::$app->request->post('place');
            $companyRecruit->record = Yii::$app->request->post('record');
            $companyRecruit->salary = Yii::$app->request->post('salary');
            $companyRecruit->contacts = Yii::$app->request->post('contacts');
            $companyRecruit->exp = Yii::$app->request->post('exp');
            $companyRecruit->datetime = date('Y-m-d H:i:s');
            $companyRecruit->state = '1';
        }

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
        $type = Yii::$app->request->get('type');
        $companyId = Yii::$app->session['companyId'];

        $para = [];
        $para['position'] = $position;

        if ($companyId == 'admin' || $companyId == 'all')  {
            if($type == '0'){
                $whereStr = 'state = "0"';
            }else{
                $whereStr = '1=1 and state != 0';
            }
        }else{
            $whereStr = 'companyId = "' . $companyId . '"';
        }
        if($position != ''){
            $whereStr = $whereStr . " and position like '%" . $position ."%'";
        }

        $query = new Query();
        $companyRecruit = $query->select('a.id as id,a.mobile as mobile,a.email as email,a.contacts as contacts,b.name as companyName,a.position as position,a.demand as demand,a.salary as salary,a.exp as exp,a.workPlace as workPlace,a.record as record,a.count as count,a.datetime as datetime,a.state as state')
            ->from('companyRecruit a')
            ->where($whereStr)
            ->leftJoin('company b', 'a.companyId = b.id');
        $page = new Pagination(['totalCount' => $companyRecruit->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $companyRecruit->offset($page->offset)->limit($page->limit)->orderBy(['datetime'=>SORT_DESC])->all();

        if($type == 0){
            return $this->render('adminlistall',[
                'companyRecruit'=>$models,
                'pages' => $page,
                'para' => $para,
                'companyId'=>$companyId,
            ]);
        }else{
            return $this->render('listall',[
                'companyRecruit'=>$models,
                'pages' => $page,
                'para' => $para,
                'companyId'=>$companyId,
            ]);
        }
    }

    /**
     * @return string
     * 打开招聘信息修改页面
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $companyRecruit = CompanyRecruit::findOne($id);
        $record = Dictitem::find()->where(['dictCode' => 'DICT_RECORD'])->all();
        return $this->render('edit',[
            'companyRecruit'=>$companyRecruit,
            'record'=>$record,
        ]);
    }

    /**
     * @return string
     * 修改一条记录
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $companyId = Yii::$app->session['companyId'];
        if($companyId == 'admin'||$companyId == 'all'){
            $companyRecruit = CompanyRecruit::findOne($id);
            $companyRecruit->position = Yii::$app->request->post('position');
            $companyRecruit->demand = Yii::$app->request->post('demand');
            $companyRecruit->mobile = Yii::$app->request->post('mobile');
            $companyRecruit->tel = Yii::$app->request->post('tel');
            $companyRecruit->email = Yii::$app->request->post('email');
            $companyRecruit->contacts = Yii::$app->request->post('contacts');
            $companyRecruit->place = Yii::$app->request->post('place');
            $companyRecruit->workPlace = Yii::$app->request->post('workPlace');
            $companyRecruit->record = Yii::$app->request->post('record');
            $companyRecruit->salary = Yii::$app->request->post('salary');
            $companyRecruit->contacts = Yii::$app->request->post('contacts');
            $companyRecruit->exp = Yii::$app->request->post('exp');
            $companyRecruit->datetime = date('Y-m-d H:i:s');
            $companyRecruit->state = '0';
        }else {
            $companyRecruit = CompanyRecruit::findOne($id);
            $companyRecruit->companyId = Yii::$app->session['companyId'];
            $companyRecruit->position = Yii::$app->request->post('position');
            $companyRecruit->demand = Yii::$app->request->post('demand');
            $companyRecruit->mobile = Yii::$app->request->post('mobile');
            $companyRecruit->tel = Yii::$app->request->post('tel');
            $companyRecruit->email = Yii::$app->request->post('email');
            $companyRecruit->contacts = Yii::$app->request->post('contacts');
            $companyRecruit->workPlace = Yii::$app->request->post('workPlace');
            $companyRecruit->place = Yii::$app->request->post('place');
            $companyRecruit->record = Yii::$app->request->post('record');
            $companyRecruit->salary = Yii::$app->request->post('salary');
            $companyRecruit->contacts = Yii::$app->request->post('contacts');
            $companyRecruit->exp = Yii::$app->request->post('exp');
            $companyRecruit->datetime = date('Y-m-d H:i:s');
            $companyRecruit->state = '1';
        }

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
        $record = Dictitem::find()->where(['dictCode' => 'DICT_RECORD'])->all();

        foreach ($record as $index => $value) {
            if ($companyRecruit->record == $value->dictItemCode) {
                $companyRecruit->record = $value->dictItemName;
            }
        }
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
            ->limit(5)
		    ->all();
        //字典反转
        $record = Dictitem::find()->where(['dictCode'=>'DICT_RECORD'])->all();
        foreach($companyRecruit as $key=>$data) {
            foreach ($record as $index => $value) {
                if ($data->record == $value->dictItemCode) {
                    $companyRecruit[$key]->record = $value->dictItemName;
                }
            }
        }

        return Json::encode($companyRecruit);
    }


    /**
     * @return string
     * 10个职位和介绍
     */
    public function actionPositions(){
        $cat = Yii::$app->request->post('cat');
        $page = Yii::$app->request->post('page');
        $index = Yii::$app->request->post('index');
        $searchValue = Yii::$app->request->post('searchValue');
        if($index == '0'&&$searchValue == '0') {
            if ($cat == 0) {
                $term = 'datetime';
            } else if ($cat == 1) {
                $term = 'datetime';
            } else if ($cat == 2) {
                $term = 'count';
            }

            $fen = CompanyRecruit::find()
                ->count();
            $pagination = new Pagination([
                'page' => $page,
                'defaultPageSize' => 6,
                'validatePage' => false,
                'totalCount' => $fen,
            ]);
            $query = new Query();
            $companyRecruit = $query->select('a.id as id,a.place as place,b.id as companyId,b.name as companyName,a.position as position,a.demand as demand,a.salary as salary,a.exp as exp,a.workPlace as workPlace,a.record as record,a.count as count,a.datetime as datetime,a.state as state')
                ->from('companyRecruit a')
                ->orderBy([$term => SORT_DESC])
                ->leftJoin('company b', 'a.companyId = b.id')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }else{
            if($index == 0){
                $whereStr = '';
                $whereStr = $whereStr . " demand like '%" . $searchValue ."%' or  position like '%" . $searchValue ."%' or  b.name like '%" . $searchValue ."%' or  contacts like '%" . $searchValue ."%' or  workPlace like '%" . $searchValue ."%' or  record like '%" . $searchValue ."%'";
            }else if($index == 1){
                $whereStr = '';
                $whereStr = $whereStr . " position like '%" . $searchValue ."%'";
            }else if($index == 2){
                $whereStr = '';
                $whereStr = $whereStr . " b.name like '%" . $searchValue ."%'";
            }
            $query = new Query();
            $fen = $query->select('a.id as id,b.id as companyId,b.name as companyName,a.position as position,a.demand as demand,a.salary as salary,a.exp as exp,a.workPlace as workPlace,a.record as record,a.count as count,a.datetime as datetime,a.state as state')
                ->from('companyRecruit a')
                ->where($whereStr)
                ->leftJoin('company b','a.companyId = b.id')
                ->count();
            $pagination = new Pagination([
                'page' => $page,
                'defaultPageSize' => 6,
                'validatePage' => false,
                'totalCount' => $fen,
            ]);

            $ye = new Query();
            $companyRecruit = $ye->select('a.id as id,a.place,b.id as companyId,b.name as companyName,a.position as position,a.demand as demand,a.salary as salary,a.exp as exp,a.workPlace as workPlace,a.record as record,a.count as count,a.datetime as datetime,a.state as state')
                ->from('companyRecruit a')
                ->where($whereStr)
                ->leftJoin('company b','a.companyId = b.id')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        }
        //字典反转
        $record = Dictitem::find()->where(['dictCode'=>'DICT_RECORD'])->all();
        foreach($companyRecruit as $key=>$data) {
            foreach ($record as $index => $value) {
                if ($data['record'] == $value->dictItemCode) {
                    $companyRecruit[$key]['record'] = $value->dictItemName;
                }
            }
        }
        $para = [];
        $para['recruit'] = Json::encode($companyRecruit);
        $para['page'] = $page;
        $para['pageSize'] = $pagination->defaultPageSize;
        $para['totalCount'] = $pagination->totalCount;
        return Json::encode($para);
    }

    /**
     * @return string
     * 公司招聘列表页
     */
    public function actionPosition(){
        $page = Yii::$app->request->post('page');
        $companyId = Yii::$app->request->post('companyId');
        $query = CompanyRecruit::find()
            ->where('companyId=:id',[':id'=>$companyId])
            ->count();
        $pagination = new Pagination([
            'page' => $page,
            'defaultPageSize' =>5,
            'validatePage' => false,
            'totalCount' => $query,
        ]);
        $recruit = CompanyRecruit::find()
            ->where('companyId=:id',[':id'=>$companyId])
            ->orderBy(['datetime' => SORT_DESC])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        //字典反转
        $record = Dictitem::find()->where(['dictCode'=>'DICT_RECORD'])->all();
        foreach($recruit as $key=>$data) {
            foreach ($record as $index => $value) {
                if ($data->record == $value->dictItemCode) {
                    $recruit[$key]->record = $value->dictItemName;
                }
            }
        }
        $para = [];
        $para['recruit'] = Json::encode($recruit);
        $para['page'] = $page;
        $para['pageSize'] = $pagination->defaultPageSize;
        $para['totalCount'] = $pagination->totalCount;
        return Json::encode($para);

    }
}



