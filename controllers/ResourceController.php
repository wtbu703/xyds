<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Resource;
use app\models\RoleResource;
use yii\data\Pagination;
use app\common\Common;

/**
 * Class ResourceController
 * @package app\controllers
 */
class ResourceController extends Controller{

    public $enableCsrfValidation = false;


	/**
	 * 前往首页
	 * @return string
	 */
	public function actionIndex(){
		$add = Common::resource('RESOURCE','ADD');
		return $this->render('list',[
			'add' => $add
		]);
	}
    /**
     * 列表页
     * @return string
     */
    public function actionFindByAttri(){
	    $tableName = Yii::$app->request->get('tableName');
	    $para= [];
	    $para['tableName'] = $tableName;
	    $whereStr = '1=1';
	    if($tableName != ''){
		    $whereStr = $whereStr." and tableName='".$tableName."'";
	    }
        $resources = Resource::find()->where($whereStr);

        $pages = new Pagination(['totalCount' =>$resources->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $resources->offset($pages->offset)->limit($pages->limit)->all();

        $delete = Common::resource('RESOURCE','DELETE');
        return $this->render('listall',[
            'resources' => $models,
            'pages' => $pages,
	        'para' => $para,
            'delete' => $delete
        ]);
    }

    /**
     * 增加资源页
     * @return string
     */
    public function actionAdd(){

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
	    'admin/main',

        'admin/menu', //打开菜单
        'admin/lock',
        'admin/unlock',
        'admin/changepwd',

        'debug',
        'default/index',
        'default/view',
        'dict/findall',
        'dict/info',
        'dict/dict',

	    'front/index',
	    'front/contactus',
        'front/about',
	    'front/con-add',
	    'front/enterprise-display',
	    'front/enterprise-detail',
	    'front/third',
	    'front/third-detail',
	    'front/line',
	    'front/detail',
	    'front/public-info',
	    'front/info-detail',
	    'front/ectrain',
	    'front/train-notice',
	    'front/train-detail',
	    'front/online-video',
	    'front/video-detail',
	    'front/product-display',
	    'front/product-detail',
	    'front/ec-info',
	    'front/ec-info-detail',
	    'front/search',
	    'front/find-more',
	    'front/company-news',
	    'front/news-detail',
	    'front/signup',
	    'front/sign',
	    'front/data-statistic',
	    'front/service-site',
	    'article/index-article',
	    'ectrain/ectrain-index',

        'article/hot-news',
        'article/article',

	    'video/video-index',
        'video/ectrain-video',
        'video/video-all',

	    'public-info/info-one',
        'public-info/info',
        'public-info/state',
	    'public-info/index-info',
	    'public-info/state',

        'company/company-index',
        'company/hot-company',
        'company/dict',
        'company/company',

        'company-recruit/search',
        'company-recruit/positions',
        'company-recruit/company-recruit',

        'company-news/company-news',
        'company-news/all-news',

        'company-shoplink/company-shoplink',

        'company-product/company-product',
        'company-product/product-display',

        'ectrain-enter/examine',

        'ectrain/ectrain',
        'ectrain/ec-category',
        'ectrain/list',
        'ectrain/listall',
        'ectrain/add',
        'ectrain/add-one',
        'ectrain/delete',
        'ectrain/delete-more',
        'ectrain/ectrain-index',
        'ectrain/dict',
        'ectrain/ectrain-all',
        'ectrain/uploadss',
        'ectrain/upload',
        'ectrain/find-one',
        'ectrain/find-by-attri',
        'ectrain/update',
        'ectrain/update-one',
		//数据统计
	    'service-site/ajax',
	    'service-site/generate-pic',
	    'county-economic/ajax',
	    'ectrain-info/ajax',
	    'ectrain-enter/ajax',
	    'logistics-build/ajax'
    ];

    /**
     * 导出数据库数据为excel表
     */
    /*public function actionExcel(){
        Common::Excel(new Resource());
    }*/

}