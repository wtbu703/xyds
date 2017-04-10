<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\CompanyNews;
use yii\data\Pagination;
use app\common\Common;
use yii\helpers\json;

class CompanyNewsController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * 显示新闻管理页面
     * @return string
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * @return string
     * 打开添加新闻页面
     */
    public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * @return string
     * 添加一条新闻
     */
    public function actionAddOne()
    {
        $companyNews = new CompanyNews();
        $companyNews->id = Common::create40ID();
        $companyNews->companyId = Yii::$app->request->post('companyId');
        $companyNews->title = Yii::$app->request->post('title');
        $companyNews->content = Yii::$app->request->post('content');
        $companyNews->keyword = Yii::$app->request->post('keyword');
        $companyNews->attachUrl = Yii::$app->request->post('attachUrl');
        $companyNews->attachName = Yii::$app->request->post('attachName');
        $companyNews->picUrl = Yii::$app->request->post('picUrl');
        $companyNews->published = date("Y-m-d H:i:s");

        if ($companyNews->save()) {
            return "success";
        } else {
            return "fail";
        }
    }

    /**
     * @return string
     * 打开新闻修改页面
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $companyNews = CompanyNews::findOne($id);
        return $this->render('edit',[
            'companyNews'=>$companyNews,
        ]);
    }

    /**
     * @return string
     * 修改一条记录
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $attachUrl = Yii::$app->request->post('attachUrl');
        $picUrl = Yii::$app->request->post('picUrl');
        $companyNews = CompanyNews::findOne($id);
        if($companyNews->attachUrl != $attachUrl&&$companyNews->attachUrl != ''&&$attachUrl !=''&&file_exists($companyNews->attachUrl)){
            unlink($companyNews->attachUrl );
        }
        if($attachUrl != '') {
            $companyNews->attachUrl = $attachUrl;
            $companyNews->attachName = Yii::$app->request->post('attachName');
        }
        if($companyNews->picUrl != $picUrl&&$companyNews->picUrl != ''&&$picUrl !=''&&file_exists($companyNews->picUrl)){
            unlink($companyNews->picUrl );
        }
        if($picUrl != '') {
            $companyNews->picUrl = $picUrl;
        }
        $companyNews->companyId = Yii::$app->request->post('companyId');
        $companyNews->title = Yii::$app->request->post('title');
        $companyNews->content = Yii::$app->request->post('content');
        $companyNews->keyword = Yii::$app->request->post('keyword');

        if($companyNews->save()) {
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * @删除一条记录
     */
    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $companyNews = CompanyNews::findOne($id);
        if($companyNews->attachUrl !=''&&file_exists($companyNews->attachUrl)) {
            unlink($companyNews->attachUrl);
        }
        if($companyNews->picUrl != ''&&file_exists($companyNews->picUrl)) {
            unlink($companyNews->picUrl);
        }
        if($companyNews->delete()) {
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 根据id删除多条记录
     */
    public function actionDeleteMore(){
        $ids = Yii::$app->request->post('ids');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key=>$data){
            $companyNews = CompanyNews::findOne($data);
            if($companyNews->attachUrl !=''&&file_exists($companyNews->attachUrl)) {
                unlink($companyNews->attachUrl);
            }
            if($companyNews->picUrl != ''&&file_exists($companyNews->picUrl)) {
                unlink($companyNews->picUrl);
            }
            CompanyNews::deleteall('id=:id',[':id'=>$data]);
        }
        return "success";
    }

    /**
     * @return string
     * 打开新闻的详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $companyNews = CompanyNews::findOne($id);
        return $this->render('detail',[
            'companyNews'=>$companyNews
        ]);
    }

    /**
     * 根据新闻标题查询新闻
     * @return string
     */
    public function actionFindByAttri(){
        $title = Yii::$app->request->get('title');
        $keyword = Yii::$app->request->get('keyword');
        $newsdateTime_1 = Yii::$app->request->get('newsdateTime_1');
        $newsdateTime_2 = Yii::$app->request->get('newsdateTime_2');

        $para = [];
        $para['title'] = $title;
        $para['keyword'] = $keyword;
        $para['newsdateTime_1'] = $newsdateTime_1;
        $para['newsdateTime_2'] = $newsdateTime_2;

        $whereStr = '1=1';
        if($title != ''){
            $whereStr = $whereStr . " and title like '%" . $title . "%'" ;
        }
        if ($keyword != '') {
            $whereStr = $whereStr . " and keyword '%" . $keyword ."%'";
        }
        if($newsdateTime_1 != ''){
            $whereStr = $whereStr." and datetime >= '".$newsdateTime_1."%'";
        }
        if($newsdateTime_2 != ''){
            $whereStr = $whereStr." and datetime <= '".$newsdateTime_2."%'";
        }

        $companyNews = CompanyNews::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $companyNews->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $companyNews->offset($page->offset)->limit($page->limit)->all();

        return $this->render('listall',[
            'companyNews' => $models,
            'pages' => $page,
            'para' => $para,
        ]);
    }

    /**
     * 上传文件
     * @return string
     */
    public function actionUpload(){

        if (Yii::$app->request->isPost) {

            $fileArg = Common::upload($_FILES,false,false);
            return $this->render('upload',[
                "fileArg" => $fileArg,
                "tag" => $fileArg['tag'],
            ]);
        }
        return $this->render('upload',[
            "tag" => "empty",
            "fileArg" =>[
                "fileName" => "",     //保存到数据库的文件名称
                "fileSaveUrl" =>"",//上传文件保存的路径
                "tag" => "",//当为success表示上传成功，当为error时表示文件过大或是文件类型不对
            ],
        ]);
    }
    /*
     * 上传图片
     */
    public function actionUploads(){
        //实现上传
        if (Yii::$app->request->isPost) {
            $isThumb = Yii::$app->request->get('isThumb');
            $views = 'uploads';
            if(is_null($isThumb)){
                $fileArg = Common::upload($_FILES,true,false);
            }else{
                $fileArg = Common::upload($_FILES,true,true);
                $views = 'uploads';
            }

            return $this->render($views,[
                "fileArg" => $fileArg,
                "tag" => $fileArg['tag'],
            ]);
        }
        $detail = Yii::$app->request->get('detail');
        if(is_null($detail)){
            return $this->render('uploads',[
                "tag" => "empty",
                "fileArg" =>[
                    "fileSaveUrl" =>"",//上传文件保存的路径
                    "tag" => "",//当为success表示上传成功，当为error时表示文件过大或是文件类型不对
                ],
            ]);
        }else{
            return $this->render('uploads',[
                "tag" => "empty",
                "fileArg" =>[
                    "fileSaveUrl" =>"",//上传文件保存的路径
                    "tag" => "",//当为success表示上传成功，当为error时表示文件过大或是文件类型不对
                ],
            ]);
        }
    }

	/**
	 * 企业新闻接口
	 * @return string
	 */
	public function actionCompanyNews(){
	    $companyId = Yii::$app->request->post('companyId');
	    $companyNews = CompanyNews::find()
		    ->where('companyId = :companyId',[":companyId" => $companyId])->all();
        return Json::encode($companyNews);
    }

	/**
	 * 企业新闻接口
	 * @return string
	 */
	public function actionAllNews(){
		$newsType = Yii::$app->request->post('newsType');
		$companyId = Yii::$app->request->post('companyId');
		$articles = CompanyNews::find()
			->where('category = :type and companyId = :companyId',[":type"=>$newsType,":companyId" => $companyId])
			->limit(6)
			->orderBy(['datetime'=>SORT_DESC])
			->all();
		return Json::encode($articles);
	}
}