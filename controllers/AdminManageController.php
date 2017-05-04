<?php

namespace app\controllers;

use app\models\AdminRole;
use app\models\Role;
use yii;
use yii\web\Controller;
use app\models\Admin;
use app\models\Dictitem;
use app\common\Common;
use yii\data\Pagination;
use yii\db\Query;

/**
 * Class AdminmanageController
 * @package app\controllers
 */
class AdminManageController extends Controller{

    public $enableCsrfValidation = false;

	/**
	 * @return string
	 */
	public function actionList(){

        $add = Common::resource('ADMIN','ADD');
        $excel = Common::resource('ADMIN','EXCEL');
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
     * 根据条件查找多条记录
     * @return string
     */
    public function actionFindByAttri(){

        $username = Yii::$app->request->get('username');
        $truename = Yii::$app->request->get('truename');
        $state = Yii::$app->request->get('state');
	    $role = Yii::$app->request->get('role');
        $para= [];
        $para['username'] = $username;
        $para['truename'] = $truename;
        $para['state'] = $state;
	    $para['role'] = $role;
        $whereStr = '1=1';
        if($username != ''){
            $whereStr = $whereStr." and a.username like '%".$username."%'";
        }
        if($truename != ''){
            $whereStr = $whereStr." and a.truename like '%".$truename."%'";
        }
        if($state != ''){
            $whereStr = $whereStr." and a.state=".$state;
        }
	    if($role != ''){
		    $whereStr = $whereStr." and b.roleId= '".$role."'";
	    }
	    $query = new Query();
	    $users = $query->select('a.id as id,a.username as username,a.truename as truename,a.telephone as telephone,a.state as state,b.roleId as roleId')
		    ->from('admin a')
		    ->where($whereStr)
		    ->leftJoin('admin_role b','a.id = b.userId');
        //$users = Admin::find()->where($whereStr);
        $pages = new Pagination(['totalCount' =>$users->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $users->offset($pages->offset)->limit($pages->limit)->all();
        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();
	    $roles = Role::find()->all();

        foreach($models as $key=>$data) {
            foreach ($dictItem as $index => $value) {
	            if ($data['state'] == $value->dictItemCode) {
		            $models[$key]['state'] = $value->dictItemName;
                }
            }
	        if(!is_null($data['roleId'])){
				foreach($roles as $index => $value){
					if($data['roleId'] == $value->id){
						$models[$key]['roleId'] = $value->name;
					}
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
    public function actionCheckUsername(){
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
    public function actionAddOne(){

        $user = new Admin();
        $user->id = Common::generateID();
        $user->username = Yii::$app->request->post('username');
        $user->truename = Yii::$app->request->post('truename');
        $user->password = Common::hashMD5(Yii::$app->request->post('password'));
        $user->telephone = Yii::$app->request->post('mobilephone');
        $user->state = '1';
	    $user->created_at = date("Y-m-d H:i:s");
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
    public function actionUpdateOne(){

        $id = Yii::$app->request->post('id');
        $user = Admin::findOne($id);
        $user->truename = Yii::$app->request->post('truename');
        $user->telephone = Yii::$app->request->post('mobilephone');
        $user->state = Yii::$app->request->post('userState');
	    $user->updated_at = date("Y-m-d H:i:s");
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
    public function actionDeleteOne(){

        $id = Yii::$app->request->post("id");
        $user = Admin::findOne($id);
        if($user->delete()){
	        AdminRole::deleteAll('userId = :userId',[':userId'=>$id]);
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
            Admin::deleteAll('id = :id',[':id'=>$data]);
	        AdminRole::deleteAll('userId = :userId',[':userId'=>$data]);
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
        $user = Admin::findOne($id);

        //字典反转
        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();


        foreach ($dictItem as $index => $value) {
	        if (!empty($value->dictItemCode)) {
		        if ($user->state == $value->dictItemCode) {
			        /** @noinspection PhpUndefinedFieldInspection */
			        $user->state = $value->dictItemName;
		        }
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
    /*public function actionExcel(){
        Common::Excel(new Admin());
    }*/
}