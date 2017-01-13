<?php

namespace app\controllers;

use app\models\Resource;
use Yii;
use yii\web\Controller;
use app\models\Admin;
use app\models\Dictitem;
use app\common\Common;
use yii\data\Pagination;

class AdminmanageController extends Controller{

    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionList(){

        $add = Common::resource('ADMIN','ADD');
        $excel = Common::resource('ADMIN','EXCEL');
        return $this->render('list',[
            'add' => $add,
            'excel' => $excel
        ]);

    }

    public function actionAdd(){

        return $this->render('add');
    }

    /**
     * 根据条件查找多条记录
     * @return string
     */
    public function actionFindbyattri(){

        $username = Yii::$app->request->get('username');
        $truename = Yii::$app->request->get('truename');
        $state = Yii::$app->request->get('state');
        $para=array();
        $para['username'] = $username;
        $para['truename'] = $truename;
        $para['state'] = $state;
        $whereStr = '1=1';
        if($username != ''){
            $whereStr = $whereStr." and username like '%".$username."%'";
        }
        if($truename != ''){
            $whereStr = $whereStr." and truename like '%".$truename."%'";
        }
        if($state != ''){
            $whereStr = $whereStr." and state=".$state;
        }
        $users = Admin::find()->where($whereStr);
        $pages = new Pagination(['totalCount' =>$users->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $users->offset($pages->offset)->limit($pages->limit)->all();
        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();

        foreach($models as $key=>$data) {
            foreach ($dictItem as $index => $value) {
                if ($data->state == $value->dictItemCode) {
                    $models[$key]->state = $value->dictItemName;
                }
            }

        }
        $edit = Common::resource('ADMIN','EDIT1');
        $delete = Common::resource('ADMIN','DELETE');
        return $this->render('listall',[
            'users' => $models,
            'pages' => $pages,
            'para' => $para,
            'edit' => $edit,
            'delete' => $delete
        ]);
    }

    /**
     * 检查用户名是否重复
     * @return string
     */
    public function actionCheckusername(){
        $username = Yii::$app->request->get('username');
        $user = Admin::find()->where(['username' => $username])->one();
        if(is_null($user)){
            return "success";
        }else{
            return "exist";
        }
    }

    /**
     * 插入一条记录到数据库
     * @return string
     */
    public function actionAddone(){

        $user = new Admin();
        $user->id = Common::generateID();
        $user->username = Yii::$app->request->post('username');
        $user->truename = Yii::$app->request->post('truename');
        $user->password = Common::hashMD5(Yii::$app->request->post('password'));
        $user->telephone = Yii::$app->request->post('mobilephone');
        $user->state = '1';
        if($user->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 查找记录并前往修改
     * @return string
     */
    public function actionUpdate(){

        $id = Yii::$app->request->get('id');
        $user = Admin::findOne($id);
        $statedict = Dictitem::find()->where(['dictCode' => 'DICT_STATE'])->all();
        return $this->render('edit',[
            'user' => $user,
            'statedict' => $statedict,
        ]);
    }

    /**
     * 修改一条记录并保存到数据库
     * @return string|void
     */
    public function actionUpdateone(){

        $id = Yii::$app->request->post('id');
        $user = Admin::findOne($id);
        $user->truename = Yii::$app->request->post('truename');
        $user->telephone = Yii::$app->request->post('mobilephone');
        $user->state = Yii::$app->request->post('userState');
        if ($user->save()){
            return 'success';
        }else{
            return 'fail';
        }
    }

    /**
     * 重置密码
     * @return string
     */
    /*public function actionReset(){

        $id = Yii::$app->request->post('id');
        $user = Admin::findOne($id);
        $user->password = Common::hashMD5(Common::PASSWORD);
        if($user->save()){
            return "success";
        }else{
            return "fail";
        }
    }*/

    /**
     * 根据ID删除一条记录
     * @return string
     */
    public function actionDeleteone(){

        $id = Yii::$app->request->post("id");
        $user = Admin::findOne($id);
        if($user->delete()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 删除多条记录
     * @return string
     */
    public function actionDeletemore(){

        $ids = Yii::$app->request->post("ids");
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key => $data){
            Admin::deleteAll('id = :id',[':id'=>$data]);
        }
        return 'success';
    }

    /**
     *获取一条记录
     * @return string
     */
    public function actionFindone()
    {
        $id = Yii::$app->request->get('id');
        $user = Admin::findOne($id);

        //字典反转
        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();


        foreach ($dictItem as $index => $value) {
            if ($user->state == $value->dictItemCode) {
                $user->state = $value->dictItemName;
            }
        }
        //结束
        return $this->render('detail',[
            'user'=>$user,
        ]);
    }

    /**
     * 导出数据库数据为excel表
     */
    public function actionExcel(){
        Common::Excel(new Admin());
    }
}