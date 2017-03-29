<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\PlatformRecruit;
use app\models\CompanyRecruit;
use yii\data\Pagination;
use app\common\Common;
use yii\helpers\Json;

class PlatformRecruitController extends Controller{
    public $enableCsrfValidation = false;

    /**
     * @return string
     * 打开平台招聘信息管理页面
     */
    public function actionList(){
        return $this->render('list');
    }

    /**
     * @return string
     * 打开添加平台招聘信息页面
     */
    public function actionAdd(){
        return $this->render('add');
    }

    /**
     * @return string
     * 添加一条平台招聘信息
     */
    public function actionAddOne(){
        $platformRecruit = new PlatformRecruit();
        $platformRecruit->id = Common::create40ID();
        $platformRecruit->position = Yii::$app->request->post('position');
        $platformRecruit->demand = Yii::$app->request->post('demand');
        $platformRecruit->mobile = Yii::$app->request->post('mobile');
        $platformRecruit->tel = Yii::$app->request->post('tel');
        $platformRecruit->email = Yii::$app->request->post('email');
        $platformRecruit->contacts = Yii::$app->request->post('contacts');

        if($platformRecruit->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 查询多条平台招聘信息
     */
    public function actionFindByAttri(){
        $position = Yii::$app->request->get('position');

        $para = [];
        $para['position'] = $position;

        $whereStr = '1=1';
        if($position != ''){
            $whereStr = $whereStr . " and position like '%" . $position ."%'";
        }
        $platformRecruit = PlatformRecruit::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $platformRecruit->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $platformRecruit->offset($page->offset)->limit($page->limit)->all();

        return $this->render('listall',[
            'platformRecruit'=>$models,
            'pages' => $page,
            'para' => $para,
        ]);
    }

    /**
     * @return string
     * 打开平台招聘信息修改页面
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $platformRecruit = PlatformRecruit::findOne($id);
        return $this->render('edit',[
            'platformRecruit'=>$platformRecruit,
        ]);
    }

    /**
     * @return string
     * 修改一条记录
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $platformRecruit = PlatformRecruit::findOne($id);
        $platformRecruit->position = Yii::$app->request->post('position');
        $platformRecruit->demand = Yii::$app->request->post('demand');
        $platformRecruit->mobile = Yii::$app->request->post('mobile');
        $platformRecruit->tel = Yii::$app->request->post('tel');
        $platformRecruit->email = Yii::$app->request->post('email');
        $platformRecruit->contacts = Yii::$app->request->post('contacts');

        if($platformRecruit->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除一条平台招聘信息
     */
    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $platformRecruit = PlatformRecruit::findOne($id);

        if($platformRecruit->delete()){
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
            PlatformRecruit::deleteall('id=:id',[':id'=>$data]);
        }
    }

    /**
     * @return string
     * 打开平台招聘信息详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $platformRecruit = PlatformRecruit::findOne($id);
        return $this->render('detail',[
            'platformRecruit'=>$platformRecruit
        ]);
    }

    public function actionPlatformRecruit(){
        $platformRecruit = PlatformRecruit::find()
            ->all();
        return Json::encode($platformRecruit);
    }

    /**
     * @return string
     * 6个热门职位的接口
     */
    public function actionPosition(){
        $companyRecruit = CompanyRecruit::find()
            ->orderBy(['count'=>SORT_DESC])
            ->select('position')
            ->limit(6)
            ->all();
        return Json::encode($companyRecruit);
    }
    public function actionPositions(){
        $companyRecruit = CompanyRecruit::find()
            ->orderBy(['count'=>SORT_DESC])
            ->select('position,demand')
            ->limit(6)
            ->all();
        return Json::encode($companyRecruit);
    }
}



