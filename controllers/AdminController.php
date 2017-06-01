<?php

namespace app\controllers;

use app\models\MenuRole;
use Yii;
use yii\web\Controller;
use app\models\Admin;
use app\models\Menu;
use app\common\Common;
use yii\helpers\Json;
use app\models\AdminRole;
use yii\db\Query;

/**
 * @property array|\yii\db\ActiveRecord[] backendMenus
 */
class AdminController extends Controller{

    public $layout = false;
    public $enableCsrfValidation = false;

	public function actions()
    {
        return  [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'backColor'=>0x000000,//背景颜色
                'maxLength' => 4, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 3,//间距
                'height' => 30,//高度
                'width' => 70,  //宽度
                //'foreColor'=>0xffffff,//字体颜色
                'offset'=>2,        //设置字符偏移量 有效果
            ],
        ];
    }

	/**
	 * @return string
	 */
	public function actionIndex(){

        return $this->render('index');

    }

    /**
     * 检查登陆是否正确
     * @return string
     */
    public function actionLogincheck(){

        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $checkCode = Yii::$app->request->post('checkCode');
	    $trueCode = Yii::$app->session['captcha'];
        if(strtolower($trueCode) == strtolower($checkCode))
        {
            $model = Admin::find()
                ->where(('username = :username and password = :password and state = 1'),[':username' => $username,':password' => Common::hashMD5($password)]);

            $AdminCount = $model->count();

            $admin = $model->one();

            if($AdminCount != 1)
            {
                return 'error';

            }else{

                Yii::$app->session['username'] = $username;
	            if (!empty($admin->id)) {
		            Yii::$app->session['userId'] = $admin->id;
	            }
	            if (!empty($admin->truename)) {
		            Yii::$app->session['truename'] = $admin->truename;
	            }

                $admin_role = AdminRole::find()->where('userId = :userId',[":userId"=>$admin->id])->one();
	            $roleId = $admin_role->roleId;
	            if (!empty($roleId)) {
		            Yii::$app->session['roleId'] = $roleId;
		            if($roleId == '2'){//如果是超管
			            Yii::$app->session['companyId'] = 'admin';
		            }elseif($roleId == 'zsyj5919949a95ad87zsyj58750313'){//如果是平台管理员
			            Yii::$app->session['companyId'] = 'all';
		            }else{
			            if(!empty($admin->companyId)){//企业ID存入session
				            Yii::$app->session['companyId'] = $admin->companyId;
			            }
		            }
	            }

	            if(!empty($admin->siteId)){//服务站点Id存入session
		            Yii::$app->session['siteId'] = $admin->siteId;
	            }

                Yii::$app->session->remove('checkCode');
                return 'success';

            }

        }else{
            return 'checkCodeWrong';
        }

    }

	/**
	 * @return string
	 */
	public function actionBackend(){

		$query = new Query();
		$models = $query->select('a.id as id,a.menuName as menuName,a.menuUrl as menuUrl,a.upLevelMenu as upLevelMenu,a.menuLevel as menuLevel')
			->from('menu a')
			->where(['a.state' => '1', 'a.menuLevel' => '1','b.roleId'=>Yii::$app->session['roleId']])
			->orderBy('a.orderBy')
			->leftJoin('menu_role b','a.id = b.menuId')
			->all();

        return $this->render('backend',[
            'models' => $models
        ]);

    }

	/**
	 * @return string
	 */
	public function actionMain(){

        return $this->renderPartial("main");

    }

	/**
	 * @return string
	 */
	public function actionMenu(){

        if(Yii::$app->request->isAjax){//是否ajax请求
            $menuId = Yii::$app->request->post('id');
            /*$menus = Menu::find()
                ->where("menuLevel>'1'")
                ->where("state='1'")
                ->orderBy('orderBy')
                ->all();*/
            $query = new Query();
            $menus = $query->select('a.id as id,a.menuName as menuName,a.menuUrl as menuUrl,a.upLevelMenu as upLevelMenu,a.menuLevel as menuLevel')
                ->from('menu a')
                ->where("a.menuLevel>'1'")
                ->where(['a.state' => '1', 'b.roleId'=>Yii::$app->session['roleId']])
                ->orderBy('a.orderBy')
                ->leftJoin('menu_role b','a.id = b.menuId')
                ->all();
            return Json::encode($menus);//Yii 的方法将数组处理成json数据
        }
    }

    /**
     * 注销
     * @return string
     */
    public function actionLogout(){

	    //Yii::$app->session->clear();
	    Yii::$app->session->destroy();
        Yii::$app->cache->flush();
        return $this->render('index');

    }

    /**
     * 锁屏
     * @return string
     */
    public function actionLock(){

        Yii::$app->session->remove('username');
        Yii::$app->session->remove('userId');
        Yii::$app->session->remove('truename');
        Yii::$app->session['times'] = 0;

        return 'success';
    }

    /**
     * 解锁
     * @return string
     */
    public function actionUnlock(){

        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        $usersStr = Admin::find()
            ->where(('username = :username and password = :password'),[':username' => $username,':password' => Common::hashMD5($password)]);
        $usersCount = $usersStr->count();
        $user = $usersStr->one();
        if($usersCount == 0){
            Yii::$app->session['times'] = Yii::$app->session['times'] + 1;
            if(Yii::$app->session['times'] > 3){
                Yii::$app->session->remove('times');
                return '3';
            }
            return 'failure';
        }else{
            Yii::$app->session['username'] = $username;
	        if (!empty($user->id)) {
		        Yii::$app->session['userId'] = $user->id;
	        }
	        if (!empty($user->truename)) {
		        Yii::$app->session['truename'] = $user->truename;
	        }
            Yii::$app->session->remove('times');
            return '1';
        }
    }

    /**
     * 修改密码
     * @return string
     */
    public function actionChangepwd(){

        $oldPWD = Yii::$app->request->post('oldPWD');
        $newPWD = Yii::$app->request->post('newPWD');
        $user = Admin::find()
            ->where(('id = :id and password = :password'),
                [
                    ':id' => Yii::$app->session['userId'],
                    ':password' => Common::hashMD5($oldPWD)
                ])
            ->one();
        if(is_null($user)){
            return "fail";
        }else{
	        $user->password = Common::hashMD5($newPWD);
            $user->save();
            return "success";
        }
    }

    /**
     * 列表页
     * @return string
     */
    public function actionList(){

        return $this->render('list');

    }

	/**
	 * @return string
	 */
	public function actionTree(){

        $menus = Menu::find()
            ->where("state = '1' ")
            ->orderBy('orderBy')
            ->all();

        return $this->render("tree",[
            'menus' => $menus
        ]);
    }

    /**
     * 获取一条目录
     * @return string
     */
    public function actionFindone(){

        $menuLevel = Yii::$app->request->get('menuLevel');
        if($menuLevel == '1'){
            $menu = null;
            $level = '1';
        }else{
            $menuId = Yii::$app->request->get('uplevelMenu');
            $menu = Menu::findOne($menuId);
            $level = intval($menu->menuLevel)+1;
        }
        return $this->render("add",[
            'menu' => $menu,
            'level' => $level
        ]);

    }

    /**
     * 添加一条目录
     * @return string
     */
    public function actionAddone(){

        $bkMenu = new Menu();
        $bkMenu->menuLevel = Yii::$app->request->post('menuLevel');
        if($bkMenu->menuLevel != '1'){
            $bkMenu->upLevelMenu = Yii::$app->request->post("uplevelMenu");
        }
        $bkMenu->id = Common::generateID();
        $bkMenu->menuName = Yii::$app->request->post('menuName');
        $bkMenu->menuUrl = Yii::$app->request->post('menuUrl');
        $bkMenu->state = '1';
        $bkMenu->orderBy = Yii::$app->request->post('orderBy');

        if($bkMenu->save())
        {
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 修改目录信息
     * @param $menuId
     * @return string
     */
    public function actionEdit($menuId){

        $menuId = Yii::$app->request->get('menuId');
        $menuOne = Menu::findOne($menuId);
        return $this->render("edit",[
            'menu' => $menuOne
        ]);
    }

    /**
     * 修改一条目录并保存
     * @return string
     */
    public function actionUpdateone(){

        $bkMenu = Menu::findOne(Yii::$app->request->post('id'));
        $bkMenu->menuName = Yii::$app->request->post('menuName');
        $bkMenu->menuUrl = Yii::$app->request->post('menuUrl');
        $bkMenu->state = Yii::$app->request->post('state');
        $bkMenu->orderBy = Yii::$app->request->post('orderBy');

        if($bkMenu->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 删除一条目录记录
     * @return string
     * @throws \Exception
     */
    public function actionDeleteone(){

        $menuId = Yii::$app->request->post('menuId');
        $backendMenuOne = Menu::findOne($menuId);
        if($backendMenuOne->menuLevel == "1"){
            $menus =  Menu::find()
                ->where('upLevelMenu = :id',[':id'=>$menuId])
                ->all();
            foreach($menus as $key=>$value){
                Menu::deleteAll('upLevelMenu = :id',[':id'=>$value->id]);
            }
            Menu::deleteAll('uplevelMenu = :id',[':id'=>$menuId]);

        }elseif($backendMenuOne->menuLevel == "2") {
            Menu::deleteAll('upLevelMenu = :id', [':id' => $menuId]);
        }
        if(Menu::findOne($menuId)->delete()){
	        MenuRole::deleteAll('menuId = :menuId',[':menuId'=>$menuId]);
            return "success";
        }else{
            return "fail";
        }

    }

}