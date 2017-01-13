<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\User;
use app\common\Common;
use app\models\Dictitem;
use yii\data\Pagination;

class UserController extends Controller{

    public $layout = false;
    public $enableCsrfValidation = false;

    public function actionList(){

        return $this->render('list');
    }

    public function actionAdd(){

        return $this->render('add');
    }

    /**
     * 根据条件查找多条记录
     * @return string
     */
    public function actionFindByAttri(){

        $username = Yii::$app->request->get('username');
        $truename = Yii::$app->request->get('truename');
        $state = Yii::$app->request->get('state');
        $para=array();
        $para['username'] = $username;
        $para['truename'] = $truename;
        $para['state'] = $state;
        $whereStr = 'user_type = 1';
        if($username != ''){
            $whereStr = $whereStr." and username like '%".$username."%'";
        }
        if($truename != ''){
            $whereStr = $whereStr." and truename like '%".$truename."%'";
        }
        if($state != ''){
            $whereStr = $whereStr." and userState=".$state;
        }
        $users = User::find()->where($whereStr);
        $pages = new Pagination(['totalCount' =>$users->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $users->offset($pages->offset)->limit($pages->limit)->all();
        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();
        $dictItemS = Dictitem::find()
            ->where(['dictCode' => 'DICT_SEX'])
            ->all();
        foreach($models as $key=>$data) {
            foreach ($dictItem as $index => $value) {
                if ($data->userState == $value->dictItemCode) {
                    $models[$key]->userState = $value->dictItemName;
                }
            }
            foreach($dictItemS as $index=>$value){
                if($data->sex == $value->dictItemCode){
                    $models[$key]->sex = $value->dictItemName;
                }
            }
        }
        $delete = Common::resource('USER','DELETE');
        return $this->render('listall',[
            'users' => $models,
            'pages' => $pages,
            'para' => $para,
            'delete' => $delete
        ]);
    }

    /**
     * 检查用户名是否重复
     * @return string
     */
    public function actionCheckUsername(){
        $username = Yii::$app->request->get('username');
        $user = User::find()->where(['username' => $username])->one();
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
    /*public function actionAddone(){

        $user = new User();
        $user->id = Common::generateID();
        $user->username = Yii::$app->request->post('username');
        $user->truename = Yii::$app->request->post('truename');
        $user->password = Common::hashMD5(Yii::$app->request->post('password'));
        $user->mobile = Yii::$app->request->post('mobilephone');
        $user->sex = Yii::$app->request->post('sex');
        $user->register_time = date("Y-m-d H:i:s");
        $user->userState = '1';
        $user->user_type = '1';//用户类型.1个人,2企业.
        if($user->save()){
            return "success";
        }else{
            return "fail";
        }
    }*/

    /**
     * 查找记录并前往修改
     * @return string
     */
    /*public function actionUpdate(){

        $id = Yii::$app->request->get('id');
        $user = User::findOne($id);
        $sexdict = Dictitem::find()->where(['dictCode' => 'DICT_SEX'])->all();
        $statedict = Dictitem::find()->where(['dictCode' => 'DICT_STATE'])->all();
        return $this->render('edit',[
            'user' => $user,
            'sexdict' => $sexdict,
            'statedict' => $statedict,
        ]);
    }*/

    /**
     * 修改一条记录并保存到数据库
     * @return string|void
     */
    /*public function actionUpdateOne(){

        $id = Yii::$app->request->post('id');
        $user = User::findOne($id);
        $user->truename = Yii::$app->request->post('truename');
        $user->mobile = Yii::$app->request->post('mobilephone');
        $user->sex = Yii::$app->request->post('sex');
        $user->userState = Yii::$app->request->post('userState');
        if ($user->save()){
            return 'success';
        }else{
            return 'fail';
        }
    }*/

    /**
     * 重置密码
     * @return string
     */
    /*public function actionReset(){

        $id = Yii::$app->request->post('id');
        $user = User::findOne($id);
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
    public function actionDeleteOne(){

        $id = Yii::$app->request->post("id");
        $user = User::findOne($id);
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
    public function actionDeleteMore(){

        $ids = Yii::$app->request->post("ids");
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key => $data){
            User::deleteAll('id = :id',[':id'=>$data]);
        }
        return 'success';
    }

    /**
     *获取一条记录
     * @return string
     */
    public function actionFindOne()
    {
        $id = Yii::$app->request->get('id');
        $user = User::findOne($id);

        //字典反转
        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();
        $dictItemS = Dictitem::find()
            ->where(['dictCode' => 'DICT_SEX'])
            ->all();

        foreach ($dictItem as $index => $value) {
            if ($user->userState == $value->dictItemCode) {
                $user->userState = $value->dictItemName;
            }
        }
        foreach($dictItemS as $index=>$value){
            if($user->sex == $value->dictItemCode){
                $user->sex = $value->dictItemName;
            }
        }//结束
        return $this->render('detail',[
            'user'=>$user,
        ]);
    }
}