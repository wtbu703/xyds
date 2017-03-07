<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\CountyEconomic;
use yii\data\Pagination;
use app\common\Common;

class CountyEconomicController extends Controller{
    public $enableCsrfValidation = false;

    /**
     * @return string
     * 打开年表管理页面
     */
    public function actionList(){
        return $this->render('list');
    }

    /**
     * @return string
     * 打开添加年表页面
     */
    public function actionAdd(){
        return $this->render('add');
    }

    /**
     * @return string
     * 添加一份年表
     */
    public function actionAddOne(){
        $countyEconomic = new CountyEconomic();
        $countyEconomic->id = Common::create40ID();
        $countyEconomic->year = Yii::$app->request->post('year');
        $countyEconomic->GRP = Yii::$app->request->post('GRP');
        $countyEconomic->socialConsumerTotal = Yii::$app->request->post('socialConsumerTotal');
        $countyEconomic->area = Yii::$app->request->post('area');
        $countyEconomic->townNum = Yii::$app->request->post('townNum');
        $countyEconomic->villageNum = Yii::$app->request->post('villageNum');
        $countyEconomic->permanentPopulation = Yii::$app->request->post('permanentPopulation');
        $countyEconomic->urbanPopulation = Yii::$app->request->post('urbanPopulation');
        $countyEconomic->ruralPopulation = Yii::$app->request->post('ruralPopulation');
        $countyEconomic->disposableIncome = Yii::$app->request->post('disposableIncome');
        $countyEconomic->urbanDisposableIncome = Yii::$app->request->post('urbanDisposableIncome');
        $countyEconomic->ruralDisposableIncome = Yii::$app->request->post('ruralDisposableIncome');
        $countyEconomic->ruralRoadMileage = Yii::$app->request->post('ruralRoadMileage');
        $countyEconomic->telUser = Yii::$app->request->post('telUser');
        $countyEconomic->mobileUser = Yii::$app->request->post('mobileUser');
        $countyEconomic->siGUser = Yii::$app->request->post('34GUser');
        $countyEconomic->internetAccess = Yii::$app->request->post('internetAccess');
        $countyEconomic->individualHousehold = Yii::$app->request->post('individualHousehold');
        $countyEconomic->registeredCompany = Yii::$app->request->post('registeredCompany');
        $countyEconomic->registeredCompany = Yii::$app->request->post('registeredCompany');
        $countyEconomic->onlineStore = Yii::$app->request->post('onlineStore');
        $countyEconomic->mobileStore = Yii::$app->request->post('mobileStore');
        $countyEconomic->ecTurnover = Yii::$app->request->post('ecTurnover');
        $countyEconomic->netRetailSales = Yii::$app->request->post('netRetailSales');

        if($countyEconomic->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 查询多份年表
     */
    public function actionFindByAttri(){
        $year = Yii::$app->request->get('year');

        $para = [];
        $para['year'] = $year;

        $whereStr = '1=1';
        if($year != ''){
            $whereStr = $whereStr . " and year like '%" . $year ."%'";
        }
        $countyEconomic = CountyEconomic::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $countyEconomic->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $countyEconomic->offset($page->offset)->limit($page->limit)->all();

        return $this->render('listall',[
            'countyEconomic'=>$models,
            'pages' => $page,
            'para' => $para,
        ]);
    }

    /**
     * @return string
     * 打开年表修改页面
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $countyEconomic = CountyEconomic::findOne($id);
        return $this->render('edit',[
            'countyEconomic'=>$countyEconomic,
        ]);
    }

    /**
     * @return string
     * 修改一条记录
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $countyEconomic = CountyEconomic::findOne($id);
        $countyEconomic->year = Yii::$app->request->post('year');
        $countyEconomic->GRP = Yii::$app->request->post('GRP');
        $countyEconomic->socialConsumerTotal = Yii::$app->request->post('socialConsumerTotal');
        $countyEconomic->area = Yii::$app->request->post('area');
        $countyEconomic->townNum = Yii::$app->request->post('townNum');
        $countyEconomic->villageNum = Yii::$app->request->post('villageNum');
        $countyEconomic->permanentPopulation = Yii::$app->request->post('permanentPopulation');
        $countyEconomic->urbanPopulation = Yii::$app->request->post('urbanPopulation');
        $countyEconomic->ruralPopulation = Yii::$app->request->post('ruralPopulation');
        $countyEconomic->disposableIncome = Yii::$app->request->post('disposableIncome');
        $countyEconomic->urbanDisposableIncome = Yii::$app->request->post('urbanDisposableIncome');
        $countyEconomic->ruralDisposableIncome = Yii::$app->request->post('ruralDisposableIncome');
        $countyEconomic->ruralRoadMileage = Yii::$app->request->post('ruralRoadMileage');
        $countyEconomic->telUser = Yii::$app->request->post('telUser');
        $countyEconomic->mobileUser = Yii::$app->request->post('mobileUser');
        $countyEconomic->siGUser = Yii::$app->request->post('34GUser');
        $countyEconomic->internetAccess = Yii::$app->request->post('internetAccess');
        $countyEconomic->individualHousehold = Yii::$app->request->post('individualHousehold');
        $countyEconomic->registeredCompany = Yii::$app->request->post('registeredCompany');
        $countyEconomic->registeredCompany = Yii::$app->request->post('registeredCompany');
        $countyEconomic->onlineStore = Yii::$app->request->post('onlineStore');
        $countyEconomic->mobileStore = Yii::$app->request->post('mobileStore');
        $countyEconomic->ecTurnover = Yii::$app->request->post('ecTurnover');
        $countyEconomic->netRetailSales = Yii::$app->request->post('netRetailSales');

        if($countyEconomic->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除一份年表
     */
    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $countyEconomic = CountyEconomic::findOne($id);

        if($countyEconomic->delete()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除多份年表
     */
    public function actionDeleteMore(){
        $ids = Yii::$app->request->post('ids');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key=>$data){
            CountyEconomic::deleteall('id=:id',[':id'=>$data]);
        }
    }

    /**
     * @return string
     * 打开年表详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $countyEconomic = CountyEconomic::findOne($id);
        return $this->render('detail',[
            'countyEconomic'=>$countyEconomic
        ]);
    }
}



