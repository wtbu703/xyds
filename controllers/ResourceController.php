<?php

namespace app\controllers;

//use app\models\Role;
use Yii;
use yii\web\Controller;
use app\models\Resource;
use app\models\RoleResource;
//use yii\db\Query;
use yii\data\Pagination;
use app\common\Common;

/**
 * Class ResourceController
 * @package app\controllers
 */
class ResourceController extends Controller{

    public $layout = false;
    public $enableCsrfValidation = false;

    /**
     * 列表页
     * @return string
     */
    public function actionFindByAttri(){
        /*$roleId = yii::$app->request->get('id');

        $query = new Query();
        $resources = $query->select('a.id as id,a.tableName as tableName,a.tableOpreate as tableOpreate,a.note as note')
            ->from('resource a')
            ->where("b.roleId = :id",[':id' => $roleId])
            ->leftJoin('role_resource b','a.id = b.resourceId');*/

        $resources = Resource::find()->where('1=1');

        $pages = new Pagination(['totalCount' =>$resources->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $resources->offset($pages->offset)->limit($pages->limit)->all();

        $add = Common::resource('RESOURCE','ADD');
        $excel = Common::resource('RESOURCE','EXCEL');
        $delete = Common::resource('RESOURCE','DELETE');
        return $this->render('list',[
            'resources' => $models,
            'pages' => $pages,
            'add' => $add,
            'excel' => $excel,
            'delete' => $delete,
            //'roleId' => $roleId
        ]);
    }

    /**
     * 增加资源页
     * @return string
     */
    public function actionAdd(){

        //$roleId = yii::$app->request->get('roleId');

        return $this->render('add');
    }

    /**
     * 检查控制器名是否重复
     * @return string
     */
    /*public function actionCheckOne(){

        $tableName = Yii::$app->request->get('tableName');
        $model = Resource::find()
            ->where(['tableName' => $tableName])
            ->one();
        if(is_null($model)){
            return '';
        }else{
            return 'exist';
        }
    }*/

    /**
     * 插入一条记录到数据库
     * @return string|void
     */
    public function actionAddOne(){

        $tableName = Yii::$app->request->post('tableName');

        if(is_null($tableName)){
            //return;
        }else{
            $tableOpreate = Yii::$app->request->post('tableOpreate');
            $note = Yii::$app->request->post('note');
            $tableOpreate_arry = explode('@',$tableOpreate);
            $note_arry = explode('@',$note);

            foreach($tableOpreate_arry as $key=>$data)
            {
                $resource = new Resource();
                $resource->id = Common::generateID();
                $resource->tableName = $tableName;
                $resource->tableOpreate = $tableOpreate_arry[$key];
                $resource->note = $note_arry[$key];
                $resource->save();

                /*$RoleResource = new RoleResource();
                $RoleResource->id = Common::generateID();
                $RoleResource->roleId = Yii::$app->request->post('roleId');
                $RoleResource->resourceId = $resource->id;
                $RoleResource->save();*/
            }
        }
        return 'success';
    }

    /**
     * 根据ID删除一条记录和角色资源对应关系
     * @return string
     * @throws \Exception
     */
    public function actionDeleteOne(){

        $resourceId = Yii::$app->request->post('ResourceId');
        if(Resource::findOne($resourceId)->delete()){
            RoleResource::deleteAll('resourceId = :id',[':id' => $resourceId]);
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 根据ID删除多条记录及角色资源对应关系
     * @return string
     */
    public function actionDeleteMore(){

        $ids = Yii::$app->request->post("ids");
        $id_array = explode('-',$ids);
        foreach($id_array as $key => $data){
            Resource::deleteAll('id = :id',[':id'=>$data]);
            RoleResource::deleteAll('resourceId = :id',[':id' => $data]);
        }
        return 'success';
    }

	/**
	 * @param $controllerID
	 * @param $actionID
	 * @param $roleId
	 * @return bool
	 */
	public static function findBy($controllerID, $actionID, $roleId){

        $result = Yii::$app->cache->get($controllerID.'_'.$actionID.'_'.$roleId);
        if($result){
            return true;
        }else{
            $role_resources = RoleResource::find()->where('roleId = :roleId',[":roleId"=>$roleId])->all();

            $controller_array = '';
            $action_array = '';
            foreach($role_resources as $key => $value){

	            if (!empty($value->resourceId)) {
		            $resources = Resource::findOne($value->resourceId);
		            $controller_array .= $resources->tableName;
		            $action_array .= $resources->tableOpreate;
	            }

            }
            if(strstr($controller_array,$controllerID)&&strstr($action_array,$actionID)){
                Yii::$app->cache->set($controllerID.'_'.$actionID.'_'.$roleId,true,300);
                return true;
            }else{
                return false;
            }
        }
    }

    public static $NoCheckArray = [
        'admin/index',
        'admin/logout',
        'admin/backend',
        'admin/logincheck',
        'admin/captcha',

        /*'admin/main',
        'admin/menu', //打开菜单
        'admin/lock',
        'admin/unlock',
        'admin/changepwd',*/

        'debug',
        'default/index',
        'default/view',
        'dict/findall',
    ];

    /**
     * 导出数据库数据为excel表
     */
    public function actionExcel(){
        Common::Excel(new Resource());
    }

}