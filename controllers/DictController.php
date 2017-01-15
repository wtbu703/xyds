<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Dict;
use app\models\Dictitem;
use yii\helpers\Json;
use yii\data\Pagination;
use app\common\Common;

/**
 * Class DictController
 * @package app\controllers
 */
class DictController extends Controller{

    public $layout = false;
    public $enableCsrfValidation = false;

	/**
	 * @return string
	 */
	public function actionList(){

        $add = Common::resource('DICT','ADD1');
        $excel = Common::resource('DICT','EXCEL');
        return $this->render('list',[
            'add' => $add,
            'excel' => $excel
        ]);

    }

	/**
	 * @return string
	 */
	public function actionAdd(){

        return $this->render('add');

    }

    /**
     * 检查一条记录是否存在
     * @return string
     */
    public function actionCheckone(){

        $dictCode = Yii::$app->request->get('dictCode');
        $model = Dict::find()
            ->where(['dictCode' => $dictCode])
            ->one();
        if(is_null($model)){
            return '';
        }else{
            return 'exist';
        }
    }

    /**
     * 插入一条记录
     * @return string|void
     */
    public function actionAddone(){

        $dict = new Dict();
        $dict->dictCode = Yii::$app->request->post('dictCode');
        $dict->dictName = Yii::$app->request->post('dictName');
        $dict->intro = Yii::$app->request->post('intro');
        $dict->state = '1';
        $dict->save();
        $dictItemOrders = Yii::$app->request->post('dictItemOrders');
        if(is_null($dictItemOrders)){
            //return;
        }else{
            $dictItemCodes = Yii::$app->request->post('dictItemCodes');
            $dictItemValues = Yii::$app->request->post('dictItemValues');
            $dictItemOrders_arry = explode('-',$dictItemOrders);
            $dictItemCodes_arry = explode('-',$dictItemCodes);
            $dictItemValues_arry = explode('-',$dictItemValues);

            foreach($dictItemOrders_arry as $key=>$data)
            {
                $dictitem = new Dictitem();
                $dictitem->id = Common::generateID();
                $dictitem->dictCode = $dict->dictCode;
                $dictitem->state = '1';
                $dictitem->dictItemCode = $dictItemCodes_arry[$key];
                $dictitem->dictItemName = $dictItemValues_arry[$key];
                $dictitem->orderBy = intval($data);
                $dictitem->save();
            }
        }
        return 'success';
    }

    /**
     * 根据条件查找多条记录
     * @return string
     */
    public function actionFindbyattri(){

        $dictName = Yii::$app->request->get('dictName');
        $state = Yii::$app->request->get('state');
        $para= [];
        $para['dictName'] = $dictName;
        $para['state'] = $state;
        $whereStr = "1=1";
        if($state != ''){
            $whereStr = $whereStr." and state=".$state;
        }
        if($dictName != ''){
            $whereStr = $whereStr." and dictName like '%".$dictName."%'";
        }
        $data = Dict::find()->where($whereStr);
        $pages = new Pagination(['totalCount' =>$data->count(), 'pageSize' => Common::PAGESIZE]);
        $model = $data->offset($pages->offset)
	        ->limit($pages->limit)
	        ->all();
        //以下是现实对模型中的字典项进行转化
        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();
        foreach($model as $key=>$data){
            foreach($dictItem as $index=>$value){
                if($data->state == $value->dictItemCode){
                    $model[$key]->state = $value->dictItemName;
                }
            }
        }
        //到此处截止
        $edit = Common::resource('DICT','EDIT');
        $delete = Common::resource('DICT','DELETE');
        return $this->render('listall',[
            'dicts' => $model,
            'pages' => $pages,
            'para' => $para,
            'edit' => $edit,
            'delete' => $delete
        ]);
    }

    /**
     * 查找多条记录
     * @return string
     */
    public function actionFindall(){

        $dictitems = Dictitem::find()
            ->where([
                'state' => '1',
                'dictCode' => Yii::$app->request->post('dictCode'),
            ])
            ->orderBy('orderBy')
            ->all();
        return Json::encode($dictitems);
    }

    /**
     * 获取一条记录
     * @return string
     */
    public function actionFindone(){

        $dictCode = Yii::$app->request->get('dictCode');
        $dict = Dict::find()
            ->where(['dictCode' => $dictCode])
            ->one();
        $dictItems = Dictitem::find()
            ->where(['dictCode' => $dictCode])
            ->all();
        //以下是现实对模型中的字典项进行转化
        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();
        foreach($dictItem as $index=>$value){
            if($dict->state == $value->dictItemCode){
                $dict->state = $value->dictItemName;
            }
        }
        //到此处截止
        return $this->render('detail',[
            'dict' => $dict,
            'dictItems' => $dictItems,
        ]);
    }

    /**
     * 查找记录并前往修改
     * @return string
     */
    public function actionUpdate(){

        $dictCode = Yii::$app->request->get('dictCode');
        $dict = Dict::find()
            ->where(['dictCode' => $dictCode])
            ->one();
        $dictItems = Dictitem::find()
            ->where(['dictCode' => $dictCode])
            ->all();
        return $this->render('update',[
            'dict' => $dict,
            'dictItems' => $dictItems,
        ]);
    }

    /**
     * 修改一条记录并保存到数据库
     * @return string|void
     */
    public function actionUpdateone(){

        $dictCode = Yii::$app->request->post('dictCode');
        $dict = Dict::find()
            ->where(['dictCode' => $dictCode])
            ->one();
        $dict->dictName = Yii::$app->request->post('dictName');
        $dict->intro = Yii::$app->request->post('intro');
        $dict->state = Yii::$app->request->post('state');
        $dict->save();
        $dictItemOrders = Yii::$app->request->post('dictItemOrders');
        if(is_null($dictItemOrders)){
			//return;
        }else{
            $dictItemCodes = Yii::$app->request->post('dictItemCodes');
            $dictItemValues = Yii::$app->request->post('dictItemValues');
            $dictItemIds = Yii::$app->request->post('dictItemIds');
            $dictItemOrders_arry = explode('-',$dictItemOrders);
            $dictItemCodes_arry = explode('-',$dictItemCodes);
            $dictItemValues_arry = explode('-',$dictItemValues);
            $dictItemIds_arry = explode('-',$dictItemIds);
            foreach($dictItemOrders_arry as $key=>$data)
            {
                $dictitem = new Dictitem();
                if($dictItemIds_arry[$key] == '1'){
                    $dictitem->id = Common::generateID();
                }else{
                    $dictitem = Dictitem::findOne($dictItemIds_arry[$key]);
                }

                $dictitem->dictCode = $dictCode;
                $dictitem->state = '1';
                $dictitem->dictItemCode = $dictItemCodes_arry[$key];
                $dictitem->dictItemName = $dictItemValues_arry[$key];
                $dictitem->orderBy = intval($data);
                $dictitem->save();
            }
        }
        return 'success';
    }

    /**
     * 删除一条字典项记录
     * @return string
     * @throws \Exception
     */
    public function actionDeleteoneitem(){

        if(Dictitem::findOne(Yii::$app->request->post('id'))->delete()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 删除一条字典记录，包括其下的字典项
     * @return string
     * @throws \Exception
     */
    public function actionDeleteone(){

        $dictCode = Yii::$app->request->post('dictCode');
        Dict::find()
            ->where(['dictCode' => $dictCode])
            ->delete();
        Dictitem::deleteAll('dictCode = :dictCode',[':dictCode'=>$dictCode]);
        return 'success';

    }

    /**
     * 删除多条字典记录
     * @return string
     * @throws \Exception
     */
    public function actionDelelemore(){

        $dictCodes = Yii::$app->request->post('ids');
        $dictCodes_array = explode('-',$dictCodes);
        foreach($dictCodes_array as $key=>$data){
            Dictitem::deleteAll('dictCode = :dictCode',[':dictCode'=>$data]);
            Dict::find()
                ->where(['dictCode' => $data])
                ->delete();
        }
        return 'success';

    }

    /**
     * 导出数据库数据为excel表
     */
    public function actionExcel(){
        Common::Excel(new Dict());
    }
}