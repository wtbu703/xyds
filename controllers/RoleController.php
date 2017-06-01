<?php

namespace app\controllers;

use app\models\Admin;
use app\models\Company;
use yii;
use yii\web\Controller;
use app\models\Role;
use app\common\Common;
use app\models\Dictitem;
use yii\data\Pagination;
use app\models\Menu;
use app\models\MenuRole;
use app\models\AdminRole;
use yii\db\Query;
use app\models\RoleResource;

/**
 * Class RoleController
 * @package app\controllers
 */
class RoleController extends Controller{

    public $layout = false;
    public $enableCsrfValidation = false;

	/**
	 * @return string
	 */
	public function actionList(){
        $add = Common::resource('ROLE','ADD');
        return $this->render('list',[
            'add' => $add
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
    public function actionCheckOne()
    {
        $name = Yii::$app->request->get('name');
        $role = Role::find()->where("name = :name",[':name' => $name])->one();
        if(is_null($role)){
            return "success";
        }else{
            return "exist";
        }
    }

    /**
     * 插入一条记录
     * @return string|void
     */
    public function actionAddOne()
    {
        $role = new Role();
        $role->id = Common::generateID();
        $role->name = Yii::$app->request->post('name');
        $role->state = '1';
        if($role->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 查找多条记录
     * @return string
     */
    public function actionFindAll(){

        $roles =Role::find()->all();
        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();
        foreach($roles as $key=>$data) {
            foreach ($dictItem as $index => $value) {
                if ($data->state == $value->dictItemCode) {
                    $roles[$key]->state = $value->dictItemName;
                }
            }
        }
        $edit = Common::resource('ROLE','EDIT');
        $delete = Common::resource('ROLE','DELETE');
        $fq = Common::resource('ROLE','FQ');
        $fy = Common::resource('ROLE','FY');
        $fz = Common::resource('ROLE','FZ');
        return $this->render('listall',[
            'roles' => $roles,
            'edit' => $edit,
            'delete' => $delete,
            'fq' => $fq,
            'fy' => $fy,
            'fz' => $fz
        ]);
    }

    /**
     * 查找记录并前往修改
     * @return string
     */
    public function actionUpdate(){

        $id = Yii::$app->request->get('id');
        $role = Role::findOne($id);
        $statedict = Dictitem::find()->where(['dictCode' => 'DICT_STATE'])->all();
        return $this->render('edit',[
            'role' => $role,
            'statedict' => $statedict,
        ]);
    }

    /**
     * 修改一条记录并保存到数据库
     * @return string|void
     */
    public function actionUpdateOne(){

        $id = Yii::$app->request->post('id');
        $role =Role::findOne($id);
        $role->name = Yii::$app->request->post('name');
        $role->state = Yii::$app->request->post('state');
        if ($role->save()){
            return 'success';
        }else{
            return 'fail';
        }
    }

    /**
     * 获取一条记录
     * @return string
     */
    public function actionFindOne(){

        $id = Yii::$app->request->get('id');
        $role =Role::findOne($id);
        return $this->render('detail',[
            'role'=>$role,
        ]);
    }

    /**
     * 删除一条记录
     * @return string
     * @throws \Exception
     */
    public function actionDeleteOne(){

        $id = Yii::$app->request->post("id");
        $role =Role::findOne($id);
        if($role->delete()){
	        AdminRole::deleteAll('roleId = :roleId',[':roleId'=>$id]);
	        MenuRole::deleteAll('roleId = :roleId',[':roleId'=>$id]);
	        RoleResource::deleteAll('roleId = :roleId',[':roleId'=>$id]);
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 删除多条记录
     * @return string
     * @throws \Exception
     */
    public function actionDeleteMore(){

        $id = Yii::$app->request->post("id");
        $id_array = explode('-',$id);
        foreach($id_array as $key => $data){
            Role::deleteAll('id = :id',[':id'=>$data]);
	        AdminRole::deleteAll('roleId = :roleId',[':roleId'=>$id]);
	        MenuRole::deleteAll('roleId = :roleId',[':roleId'=>$id]);
	        RoleResource::deleteAll('roleId = :roleId',[':roleId'=>$id]);
        }
        return 'success';
    }

    /**
     *为角色添加权限（能控制的菜单）
     * @return string
     */
    public function actionAccessControl(){

        $id = Yii::$app->request->get('id');
        $role = Role::findOne($id);//找出需要分配权限的角色

        if(MenuRole::find()->where('roleId = :id',[':id'=>$id])->all())
        {
            $rolemenus = MenuRole::find()
                ->where('roleId = :id',[':id'=>$id])
                ->all();
            $menuIds ='';
            foreach($rolemenus as $key => $data){

	            if (!empty($data->menuId)) {
		            $menuId = $data->menuId;
		            $menuIds .= ','.$menuId;
	            }

            }
        }else{
            $menuIds ='';
        }

        //以下为需要传到视图的变量
        $rolename = $role->name;

        //列出可用菜单
        $menus = Menu::find()
            ->where("state = '1' ")
            ->all();

        return $this->render('accesscontrol',[
            'rolename' => $rolename,
            'roleId' => $id,
            'menus' => $menus,
            'menuIds' => $menuIds,
        ]);
    }

    /**
     * 保存角色和菜单的关系
     * @return string
     */
    public function actionAddMenuRole(){

        $ids = Yii::$app->request->get('ids');
        $roleId = Yii::$app->request->get('roleId');
        $ids_array = explode(',',$ids);
        MenuRole::deleteAll('roleId = :roleId',[":roleId"=>$roleId]);
        foreach($ids_array as $key => $data)
        {
            $rolemenu = new MenuRole();//新建关系
            $rolemenu->id = Common::generateID();//生成ID
            $rolemenu->roleId = $roleId;
            $rolemenu->menuId = $data;
            $rolemenu->save();

        }
	    $add = Common::resource('ROLE','ADD');
	    return $this->render('list',[
		    'add' => $add
	    ]);

    }

    /**
     * 为角色添加用户
     * @return string
     */
    public function actionAdminControl(){

        $id = Yii::$app->request->get('id');

        $query = new Query();
        $admins = $query->select('a.id as id,a.username as username,a.truename as truename,a.state as state')
            ->from('admin a')
            ->where("b.roleId = :id",[':id' => $id])
            ->leftJoin('admin_role b','a.id = b.userId');

        $role = Role::findOne($id);

        $pages = new Pagination(['totalCount' =>$admins->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $admins->offset($pages->offset)->limit($pages->limit)->all();
        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();
        foreach($models as $key=>$data) {
            foreach ($dictItem as $index => $value) {
                if ($data['state'] == $value->dictItemCode) {
                    $models[$key]['state'] = $value->dictItemName;
                }
            }
        }
        return $this->render('admincontrol',[
            'admins' => $models,
            'pages' => $pages,
            'role' => $role,
        ]);
    }

	/*public function actionChooseCompany(){
		$adminId = Yii::$app->request->get('id');
		return $this->render('ChooseCompany',[
			'adminId' => $adminId
		]);
	}*/

	/*public function actionSelectAllCompany(){
		return yii\helpers\Json::encode(Company::find()->all());
	}*/

	/*public function actionSaveCompany(){
		$adminId = Yii::$app->request->post('adminId');
		$companyId = Yii::$app->request->post('companyId');
		$admin = Admin::findOne($adminId);
		$company = Company::findOne($companyId);
		$admin->companyId = $companyId;
		$admin->companyName = $company->name;
		if($admin->save()){
			return 'success';
		}else{
			return false;
		}
	}*/

    /**
     * 删除单个用户角色对应关系
     * @return string
     */
    public function actionDeleteOneAdminAccess(){

        $id = Yii::$app->request->post("id");
        $roleId = Yii::$app->request->post("roleId");
        AdminRole::deleteAll('userId = :id and roleId = :roleId',[':id'=>$id,':roleId'=>$roleId]);
        return "success";
    }

    /**
     * 删除多个用户角色对应关系
     * @return string
     */
    public function actionDeleteMoreAdminAccess(){

        $ids = Yii::$app->request->post("ids");
        $roleId = Yii::$app->request->post("roleId");
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key => $data){
            AdminRole::deleteAll('userId = :id and roleId = :roleId',[':id'=>$data,':roleId'=>$roleId]);
        }
        return 'success';
    }

    /**
     * 打开添加用户角色对应页面
     * @return string
     */
    public function actionAddAdminAccess(){

        $id = Yii::$app->request->get('id');
        $name = Yii::$app->request->get('name');

        $query = new Query();
        $admins = $query->select('a.id as id,a.username as username,a.truename as truename,a.state as state')
            ->from('admin a')
            ->where("b.roleId != :id or b.roleId is null",[':id' => $id])//TODO
            ->leftJoin('admin_role b','a.id = b.userId');

        $pages = new Pagination(['totalCount' =>$admins->count(), 'pageSize' => Common::PAGESIZE]);
        $model = $admins->offset($pages->offset)->limit($pages->limit)
            ->all();

        $dictItem = Dictitem::find()
            ->where(['dictCode' => 'DICT_STATE'])
            ->all();

        foreach($model as $key=>$data) {
            foreach ($dictItem as $index => $value) {
                if ($data['state'] == $value->dictItemCode) {
                    $model[$key]['state'] = $value->dictItemName;
                }
            }
        }
        return $this->render('addadmincontrol',[
            'admins' => $model,
            'pages' => $pages,
            'id' => $id,
            'name' => $name
        ]);
    }

    /**
     * 添加单个用户对角色的对应关系
     * @return string
     */
    public function actionAddOneAdminControl(){

        $ids = Yii::$app->request->post("ids");
        $roleId = Yii::$app->request->post('roleId');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key => $data){

            $admin_role = new AdminRole();
            $admin_role->id  = Common::generateID();
            $admin_role->userId = $data;
            $admin_role->roleId = $roleId;
            $admin_role->save();
        }
        return 'success';

    }

    /**
     * 打开资源管理页
     */
    public function actionResourceControl(){

        $id = Yii::$app->request->get('id');

        $query = new Query();
        $resources = $query->select('a.id as id,a.tableName as tableName,a.tableOpreate as tableOpreate,a.note as note')
            ->from('resource a')
            ->where("b.roleId = :id",[':id' => $id])
            ->leftJoin('role_resource b','a.id = b.resourceId');

        $role = Role::findOne($id);

        $pages = new Pagination(['totalCount' =>$resources->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $resources->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('ResourceControl',[
            'resources' => $models,
            'pages' => $pages,
            'role' => $role,
        ]);
    }

    /**
     * 删除单个角色资源对应关系
     * @return string
     */
    public function actionDeleteOneRoleResource(){

        $resourceId = Yii::$app->request->post("resourceId");
        $roleId = Yii::$app->request->post("roleId");
        RoleResource::deleteAll('resourceId = :id and roleId = :roleId',[':id'=>$resourceId,":roleId"=>$roleId]);
        return "success";
    }

    /**
     * 删除多个角色资源对应关系
     * @return string
     */
    public function actionDeleteMoreRoleResource(){

        $ids = Yii::$app->request->post("ids");
        $roleId = Yii::$app->request->post("roleId");
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key => $data){
            RoleResource::deleteAll('resourceId = :id and roleId = :roleId',[':id'=>$data,":roleId"=>$roleId]);
        }
        return 'success';
    }

    /**
     * 打开角色新增资源对应页面
     * @return string
     */
    public function actionAddRoleResource(){

        $id = Yii::$app->request->get('id');

        $role = Role::findOne($id);

        $query = new Query();
        $resources = $query->select('a.id as id,a.tableName as tableName,a.tableOpreate as tableOpreate,a.note as note')
            ->from('resource a')
            ->where("b.roleId != :id or b.roleId is null",[':id' => $id])
            ->leftJoin('role_resource b','a.id = b.resourceId');

        $pages = new Pagination(['totalCount' =>$resources->count(), 'pageSize' => Common::PAGESIZE]);
        $model = $resources->offset($pages->offset)->limit($pages->limit)
            ->all();

        return $this->render('AddRoleResource',[
            'resources' => $model,
            'pages' => $pages,
            'role' => $role,
        ]);
    }

    /**
     * 保存多项角色资源对应记录
     * @return string
     */
    public function actionAddMoreRoleResource(){

        $ids = Yii::$app->request->post("ids");
        $roleId = Yii::$app->request->post('roleId');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key => $data){

            $role_resource = new RoleResource();
            $role_resource->id  = Common::generateID();
            $role_resource->resourceId = $data;
            $role_resource->roleId = $roleId;
            $role_resource->save();
        }
        return 'success';

    }

    /**
     * 导出数据库数据为excel表
     */
    /*public function actionExcel(){
        Common::Excel(new Role());
    }*/

	public function actionSelectAll(){
		return yii\helpers\Json::encode(Role::find()->all());
	}
}