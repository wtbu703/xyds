<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\EctrainEnter;
use yii\data\Pagination;
use app\common\Common;

class EctrainEnterController extends Controller{
    public $enableCsrfValidation = false;

    /**
     * @return string
     * 打开培训报名信息管理页面
     */
    public function actionList(){
        return $this->render('list');
    }

    /**
     * @return string
     * 打开添加培训报名信息页面
     */
    public function actionAdd(){
        return $this->render('add');
    }

    /**
     * @return string
     * 添加一条培训报名信息
     */
    public function actionAddOne(){
        $ectrainEnter = new EctrainEnter();
        $ectrainEnter->id = Common::create40ID();
        $ectrainEnter->truename = Yii::$app->request->post('truename');
        $ectrainEnter->mobile = Yii::$app->request->post('mobile');
        $ectrainEnter->trainId = Yii::$app->request->post('trainId');
        $ectrainEnter->idCardNo = Yii::$app->request->post('idCardNo');
        $ectrainEnter->address = Yii::$app->request->post('address');
        $ectrainEnter->gender = Yii::$app->request->post('gender');
        $ectrainEnter->age = Yii::$app->request->post('age');

        if($ectrainEnter->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 查询多条培训报名信息
     */
    public function actionFindByAttri(){
        $truename = Yii::$app->request->get('truename');

        $para = [];
        $para['truename'] = $truename;

        $whereStr = '1=1';
        if($truename != ''){
            $whereStr = $whereStr . " and truename like '%" . $truename ."%'";
        }
        $ectrainEnter = EctrainEnter::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $ectrainEnter->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $ectrainEnter->offset($page->offset)->limit($page->limit)->all();

        return $this->render('listall',[
            'ectrainEnter'=>$models,
            'pages' => $page,
            'para' => $para,
        ]);
    }

    /**
     * @return string
     * 打开培训报名信息修改页面
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $ectrainEnter = EctrainEnter::findOne($id);
        return $this->render('edit',[
            'ectrainEnter'=>$ectrainEnter,
        ]);
    }

    /**
     * @return string
     * 修改一条记录
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $ectrainEnter = EctrainEnter::findOne($id);
        $ectrainEnter->truename = Yii::$app->request->post('truename');
        $ectrainEnter->mobile = Yii::$app->request->post('mobile');
        $ectrainEnter->trainId = Yii::$app->request->post('trainId');
        $ectrainEnter->idCardNo = Yii::$app->request->post('idCardNo');
        $ectrainEnter->address = Yii::$app->request->post('address');
        $ectrainEnter->gender = Yii::$app->request->post('gender');
        $ectrainEnter->age = Yii::$app->request->post('age');

        if($ectrainEnter->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除一条培训报名信息
     */
    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $ectrainEnter = EctrainEnter::findOne($id);

        if($ectrainEnter->delete()){
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
            EctrainEnter::deleteall('id=:id',[':id'=>$data]);
        }
    }

    /**
     * @return string
     * 打开培训报名信息详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $ectrainEnter = EctrainEnter::findOne($id);
        return $this->render('detail',[
            'ectrainEnter'=>$ectrainEnter
        ]);
    }

	/**
	 * 按月统计培训报名人数
	 * @return bool|string
	 */
	public function actionAjax(){
		$type = Yii::$app->request->post('type');
		if($type==1){
			$sql = Yii::$app->getDb()->createCommand("SELECT DATE_FORMAT(created,'%Y-%m')AS months,COUNT(*) AS number FROM ectrainenter GROUP BY DATE_FORMAT(created,'%Y-%m')");
			$res = $sql->queryAll();
			return yii\helpers\Json::encode($res);
		}else{
			return false;
		}
	}
}



