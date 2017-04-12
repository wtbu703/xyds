<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\CountyEconomic;
use yii\data\Pagination;
use app\common\Common;
use app\common\Phpexcel;

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

    /**
     * 前往上传页面
     * @return string
     */
    public function actionUploadExcel(){
        return $this->render('excel');
    }

    /**
     * 上传Excel
     * @return string
     */
    public function actionUpload(){

        if (Yii::$app->request->isPost) {

            $fileArg = Common::upload($_FILES,false,false);
            return $this->render('upload',[
                "fileArg" => $fileArg,
                "tag" => $fileArg['tag'],
            ]);
        }
        return $this->render('upload',[
            "tag" => "empty",
            "fileArg" =>[
                "fileName" => "",     //保存到数据库的文件名称
                "fileSaveUrl" =>"",//上传文件保存的路径
                "tag" => "",//当为success表示上传成功，当为error时表示文件过大或是文件类型不对
            ],
        ]);
    }

    /**
     * 把上传的Excel转为记录
     * @return string
     */
    public function actionSaveExcel(){

        $attachUrls = Yii::$app->request->post('attachUrls');
        $countyEconomic = new CountyEconomic();

        //使用PHPExcel读取上传的文件
        $phpExcel = new Phpexcel($countyEconomic);
        $sheetData = $phpExcel->ReadExcel($attachUrls);


        //var_dump($sheetData);//调试
        //如果格式规范
        $i= '2';
        for($i;$i>=0;$i++) {
            $year = $sheetData[$i]['B'];
            $GRP = $sheetData[$i]['C'];
            $socialConsumerTotal = $sheetData[$i]['D'];
            $area = $sheetData[$i]['E'];
            $townNum = $sheetData[$i]['F'];
            $villageNum = $sheetData[$i]['G'];
            $permanentPopulation = $sheetData[$i]['H'];
            $urbanPopulation = $sheetData[$i]['I'];
            $ruralPopulation = $sheetData[$i]['J'];
            $disposableIncome = $sheetData[$i]['K'];
            $urbanDisposableIncome = $sheetData[$i]['L'];
            $ruralDisposableIncome = $sheetData[$i]['M'];
            $ruralRoadMileage = $sheetData[$i]['N'];
            $telUser = $sheetData[$i]['O'];
            $mobileUser = $sheetData[$i]['P'];
            $siGUser = $sheetData[$i]['Q'];
            $internetAccess = $sheetData[$i]['R'];
            $individualHousehold = $sheetData[$i]['S'];
            $registeredCompany = $sheetData[$i]['T'];
            $onlineStore = $sheetData[$i]['U'];
            $mobileStore = $sheetData[$i]['V'];
            $ecTurnover = $sheetData[$i]['W'];
            $netRetailSales = $sheetData[$i]['X'];

            if (is_null($year)) {
                break;//如果为空了提前结束
            } else {
                $countyEconomic = new CountyEconomic();
                $countyEconomic->id = Common::create40ID();
                $countyEconomic->year = $year;
                $countyEconomic->GRP = $GRP;
                $countyEconomic->socialConsumerTotal = $socialConsumerTotal;
                $countyEconomic->area = $area;
                $countyEconomic->townNum = $townNum;
                $countyEconomic->villageNum = $villageNum;
                $countyEconomic->permanentPopulation = $permanentPopulation;
                $countyEconomic->urbanPopulation = $urbanPopulation;
                $countyEconomic->ruralPopulation = $ruralPopulation;
                $countyEconomic->disposableIncome = $disposableIncome;
                $countyEconomic->urbanDisposableIncome = $urbanDisposableIncome;
                $countyEconomic->ruralDisposableIncome = $ruralDisposableIncome;
                $countyEconomic->ruralRoadMileage = $ruralRoadMileage;
                $countyEconomic->telUser = $telUser;
                $countyEconomic->mobileUser = $mobileUser;
                $countyEconomic->siGUser = $siGUser;
                $countyEconomic->internetAccess = $internetAccess;
                $countyEconomic->individualHousehold = $individualHousehold;
                $countyEconomic->registeredCompany = $registeredCompany;
                $countyEconomic->onlineStore = $onlineStore;
                $countyEconomic->mobileStore = $mobileStore;
                $countyEconomic->ecTurnover = $ecTurnover;
                $countyEconomic->netRetailSales = $netRetailSales;

                $countyEconomic->save();

            }
        }
        unlink($attachUrls);//删除上传的Excel
        return "success";
    }

	public function actionAjax(){
		$type = Yii::$app->request->post('type');
		if($type==6){//年经济指标，生产总值、零售、居民人均可支配、电商交易额、网络零售额
			$sql = Yii::$app->getDb()->createCommand("SELECT year,GRP,socialConsumerTotal,disposableIncome,ecTurnover,netRetailSales FROM countyeconomic GROUP BY `year`");
			$res = $sql->queryAll();
			return yii\helpers\Json::encode($res);
		}else if($type==7){//个体工商户、注册企业数、网店数
			$sql = Yii::$app->getDb()->createCommand("SELECT year,individualHousehold,registeredCompany,onlineStore FROM countyeconomic GROUP BY `year`");
			$res = $sql->queryAll();
			return yii\helpers\Json::encode($res);
		}else if($type==8){//农村公路、互联网接入
			$sql = Yii::$app->getDb()->createCommand("SELECT year,ruralRoadMileage,internetAccess FROM countyeconomic GROUP BY `year`");
			$res = $sql->queryAll();
			return yii\helpers\Json::encode($res);
		}else{
			return false;
		}
	}
}




