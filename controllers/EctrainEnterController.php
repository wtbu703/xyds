<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\EctrainEnter;
use yii\data\Pagination;
use app\common\Common;
use app\common\Phpexcel;
use app\models\Dictitem;

class EctrainEnterController extends Controller{
    public $enableCsrfValidation = false;

    /**
     * @return string
     * 打开培训报名信息管理页面
     */
    public function actionList(){
        $id = Yii::$app->request->get('id');
        return $this->render('list',[
            'id' => $id,
        ]);
    }

    /**
     * @return string
     * 打开添加培训报名信息页面
     */
    /*public function actionAdd(){
        return $this->render('add');
    }*/

    /**
     * @return string
     * 添加一条培训报名信息
     */
    /*public function actionAddOne(){
        $ectrainEnter = new EctrainEnter();
        $ectrainEnter->id = Common::create40ID();
        $ectrainEnter->truename = Yii::$app->request->post('truename');
        $ectrainEnter->mobile = Yii::$app->request->post('mobile');
        $ectrainEnter->trainId = Yii::$app->request->post('trainId');
        $ectrainEnter->idCardNo = Yii::$app->request->post('idCardNo');
        $ectrainEnter->address = Yii::$app->request->post('address');
        $ectrainEnter->gender = Yii::$app->request->post('gender');
        $ectrainEnter->age = Yii::$app->request->post('age');
        $ectrainEnter->state = 0;

        if($ectrainEnter->save()){
            return "success";
        }else{
            return "fail";
        }
    }*/

    /**
     * @return string
     * 查询多条培训报名信息
     */
    public function actionFindByAttri(){
        $truename = Yii::$app->request->get('truename');
        $state = Yii::$app->request->get('state');
        $trainId = Yii::$app->request->get('trainId');
        $para = [];
        $para['truename'] = $truename;
        $para['state'] = $state;

        if(is_null($trainId)){
            $whereStr = '1=1';
        }else {
            $whereStr = 'trainId="' . $trainId . '"';
        }
        if($truename != ''){
            $whereStr = $whereStr . " and truename like '%" . $truename ."%'";
        }
        if($state != ''){
            $whereStr = $whereStr . " and state= '" . $state ."'";
        }
        $ectrainEnter = EctrainEnter::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $ectrainEnter->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $ectrainEnter->offset($page->offset)->limit($page->limit)->all();

        //字典反转
        $state = Dictitem::find()->where(['dictCode'=>'DICT_ENTER_STATE'])->all();
        foreach($models as $key=>$data) {
            foreach ($state as $index => $value) {
                if ($data->state == $value->dictItemCode) {
                    $models[$key]->state = $value->dictItemName;
                }
            }
        }

        return $this->render('listall',[
            'ectrainEnter'=>$models,
            'pages' => $page,
            'para' => $para,
            'trainId'=>$trainId,
        ]);
    }

    /**
     * @return string
     * 打开培训报名信息修改页面
     */
    /*public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $ectrainEnter = EctrainEnter::findOne($id);
        //字典反转
        $sex = Dictitem::find()->where(['dictCode'=>'DICT_SEX'])->all();
        return $this->render('edit',[
            'ectrainEnter'=>$ectrainEnter,
            'sex'=>$sex,
        ]);
    }*/

    /**
     * @return string
     * 修改一条记录
     */
   /* public function actionUpdateOne(){
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
    }*/

    /**
     * @return string
     * 删除一条培训报名信息
     */
   /* public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $ectrainEnter = EctrainEnter::findOne($id);

        if($ectrainEnter->delete()){
            return "success";
        }else{
            return "fail";
        }
    }*/

    /**
     * @return string
     * 删除多条记录
     */
   /* public function actionDeleteMore(){
        $ids = Yii::$app->request->post('ids');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key=>$data){
            EctrainEnter::deleteall('id=:id',[':id'=>$data]);
        }
    }*/

    /**
     *审核报名信息
     */
    public function actionExamine(){
        $ids = Yii::$app->request->post('ids');
        $state = Yii::$app->request->post('state');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key=>$data) {
            $enter = EctrainEnter::findOne($data);
            $enter->state = $state;
            $enter->save();
        }
    }
    /**
     * @return string
     * 打开培训报名信息详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $ectrainEnter = EctrainEnter::findOne($id);

        //字典反转
        $state = Dictitem::find()->where(['dictCode'=>'DICT_ENTER_STATE'])->all();
        foreach ($state as $index => $value) {
            if ($ectrainEnter->state == $value->dictItemCode) {
                $ectrainEnter->state = $value->dictItemName;
            }
        }
        $sex = Dictitem::find()->where(['dictCode'=>'DICT_SEX'])->all();
        foreach ($sex as $index => $value) {
            if ($ectrainEnter->gender == $value->dictItemCode) {
                $ectrainEnter->gender = $value->dictItemName;
            }
        }

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

	/**
	 *导出全部
	 */
	public function actionExcelAll(){
		$trainId = Yii::$app->request->get('id');
		$fromModel = EctrainEnter::find()
			->select('truename,idCardNo,mobile,address,gender,age')
			->where('trainId = :trainId',[":trainId"=>$trainId])
			->all();
		$category = Dictitem::find()
			->where(['dictCode' => 'DICT_SEX'])
			->all();
		foreach($fromModel as $key=>$data){
			foreach($category as $index=>$value){
				if($data->gender == $value->dictItemCode){
					$fromModel[$key]->gender = $value->dictItemName;
				}
			}
		}
		$attributeLabels = [
			'truename' => '真实姓名',
			'idCardNo' => '身份证号',
			'mobile' => '手机号',
			'address' => '地址',
			'gender' => '性别',
			'age' => '年龄'
		];
		$title = [];
		foreach($attributeLabels as $key => $value){
			$title[] = $value;
		}
		$models = [];
		foreach($fromModel as $key => $value){
			foreach($attributeLabels as $index => $data){
				$models[$key][$data] = $value->$index;
			}
		}
		$Phpexcel = new Phpexcel($fromModel);
		$Phpexcel->Exportexcel($title,$models,'报名情况.xls');
	}

	/**
	 *多选导出
	 */
	public function actionExcelById(){
		$ids = Yii::$app->request->get('ids');
		$ids_array = explode('-',$ids);
		$fromModel = [];
		foreach($ids_array as $key => $data){
			$fromModel[$key] = EctrainEnter::find()
				->select('truename,idCardNo,mobile,address,gender,age')
				->where('id = :id',[":id"=>$data])
				->one();
			if($fromModel[$key]->gender == 0){
				$fromModel[$key]->gender = '男';
			}else{
				$fromModel[$key]->gender = '女';
			}
		}
		$attributeLabels = [
			'truename' => '真实姓名',
			'idCardNo' => '身份证号',
			'mobile' => '手机号',
			'address' => '地址',
			'gender' => '性别',
			'age' => '年龄'
		];
		$title = [];
		foreach($attributeLabels as $key => $value){
			$title[] = $value;
		}
		$models = [];
		foreach($fromModel as $key => $value){
			foreach($attributeLabels as $index => $data){
				$models[$key][$data] = $value->$index;
			}
		}
		$Phpexcel = new Phpexcel($fromModel);
		$Phpexcel->Exportexcel($title,$models,'报名情况.xls');
	}
}



