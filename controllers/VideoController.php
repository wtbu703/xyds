<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Video;
use app\models\Dictitem;
use app\common\Common;
use yii\data\Pagination;
use yii\helpers\Json;

/**
 * Class VideoController
 * @package app\controllers
 */
class VideoController extends Controller
{
    //public $layout = false;
    public $enableCsrfValidation = false;


    /**
     * 打开视频管理页面
     * @return string
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * 根据条件查询多个视频
     * @return string
     */
    public function actionFindbyattri()
    {

        $name = Yii::$app->request->get('name');
        $source = Yii::$app->request->get('source');
        $sign = Yii::$app->request->get('sign');

        $para = [];
        $para['name'] = $name;
        $para['source'] = $source;
        $para['sign'] = $sign;

        $whereStr = '1=1';
        if ($name != '') {
            $whereStr = $whereStr . " and name like '%" . $name . "%'";
        }
        if ($source != '') {
            $whereStr = $whereStr . " and source like '%" . $source . "%'";
        }
        if($sign !=''){
            $whereStr = $whereStr . " and sign=" . $sign;
        }

        $videos = Video::find()->where($whereStr);
        $pages = new Pagination(['totalCount' => $videos->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $videos->offset($pages->offset)->limit($pages->limit)->orderBy(['datetime'=>SORT_DESC])->all();

        $sign = Dictitem::find()->where(['dictCode'=>'DICT_SIGN'])->all();
        foreach($models as $key=>$data) {
            foreach ($sign as $index => $value) {
                if ($data->sign == $value->dictItemCode) {
                    $models[$key]->sign = $value->dictItemName;
                }
            }
        }

        return $this->render('listall', [
            'videos' => $models,
            'pages' => $pages,
            'para' => $para,
        ]);
    }

    /**
     * 打开添加视频页面
     * @return string
     */
    public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * 保存视频
     * @return string
     */
    public function actionAddone(){
            $video = new Video();
            $video->id = Common::generateID();
            $video->sign = Yii::$app->request->post('sign');
            $video->source = Yii::$app->request->post('source');
            $video->datetime = date("Y-m-d H:i:s");
            $video->url = Yii::$app->request->post('attachUrls');
            $video->name = Yii::$app->request->post('name');
            $video->content = Yii::$app->request->post('content');
            $video->picUrl = Yii::$app->request->post('picUrl');
        if($video->save()){
            return "success";
        }else{
            return "fail";
        }
    }


    /**
     * 上传一个视频
     * @return string
     */
    public function actionUpload(){

        if (Yii::$app->request->isPost) {

            $fileArg = Common::upload($_FILES,false,false,false,2000*1048000);
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

    /**
     * 前往修改视频页面
     * @return string
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $video = Video::findOne($id);
        $sign = Dictitem::find()->where(['dictCode'=>'DICT_SIGN'])->all();
        return $this->render('edit',[
            'video' => $video,
            'sign' => $sign,
        ]);
    }

    /**
     * 根据ID修改一个视频并保存到数据库
     * @return string
     */
    public function actionUpdateone(){
            $id = Yii::$app->request->post('id');
            $url = Yii::$app->request->post('url');
            $picUrl = Yii::$app->request->post('picUrl');
            $video = Video::findOne($id);
            if($url != ''&&$video->url != ''&&$url != $video->url&&file_exists($video->url)){
                unlink($video->url);
            }
            if($url != ''){
                $video->url = $url;
            }
            if($picUrl != ''&&$video->picUrl != ''&&$picUrl != $video->picUrl&&file_exists($video->picUrl)){
                unlink($video->picUrl);
            }
            if($picUrl != ''){
                $video->picUrl = $picUrl;
            }
            $video->sign = Yii::$app->request->post('sign');
            $video->source = Yii::$app->request->post('source');
            $video->name = Yii::$app->request->post('name');
            $video->content = Yii::$app->request->post('content');

        if($video->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 根据ID删除一个视频
     * @return string
     */
    public function actionDeleteone(){

        $id = Yii::$app->request->post("id");
        $video = Video::findOne($id);
        if($video->url != ''&&$video->sign != 1&&file_exists($video->url)){
            unlink($video->url);
        }
        if($video->picUrl != ''&&file_exists($video->picUrl)){
            unlink($video->picUrl);
        }
        if($video->delete()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 根据ID删除多个视频
     * @return string
     */
    public function actionDeletemore(){

        $ids = Yii::$app->request->post("ids");
        $ids_array = explode('-',$ids);

        foreach($ids_array as $key => $data){
            $video = Video::findOne($data);
            if($video->url != ''&&$video->sign != 1&&file_exists($video->url)){
                unlink($video->url);
            }
            if($video->picUrl != ''&&file_exists($video->picUrl)){
                unlink($video->picUrl);
            }
            Video::deleteAll('id = :id',[':id'=>$data]);
        }
        return 'success';
    }

    /**
     *根据ID获取一条记录
     * @return string
     */
    public function actionFindone()
    {
        $id = Yii::$app->request->get('id');
        $video = Video::findOne($id);

        return $this->render('detail', [
            'video' => $video,
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
                $fileArg = Common::upload($_FILES,true,false,'ectrain_video',5*2048000);
            }else{
                $fileArg = Common::upload($_FILES,true,false,'ectrain_video',5*1048000);
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
	 * 首页视频接口
	 * @return string
	 */
	public function actionVideoIndex(){
        $video = Video::find()
            ->orderBy(['datetime' => SORT_DESC])
            ->limit(1)
            ->all();
        return Json::encode($video);
    }

	/**
	 * 电商培训页视频接口
	 * @return string
	 */
	public function actionEctrainVideo(){
		$video = Video::find()
			->orderBy(['datetime' => SORT_DESC])
			->limit(6)
			->all();
		return Json::encode($video);
	}

	/**
	 * 在线视频页接口
	 * @return string
	 */
	public function actionVideoAll(){
        $newsType = Yii::$app->request->post('newsType');
        $page = Yii::$app->request->post('page');
        $newsType = $newsType-1;
        if($newsType == -1){
            $query = Video::find()
                ->count();
        }else{
            $query = Video::find()
                ->where('sign=:sign', [':sign' => $newsType])
                ->count();
        }
        $pagination = new Pagination([
            'page' => $page,
            'defaultPageSize' => 5,
            'validatePage' => false,
            'totalCount' => $query,
        ]);
        if($newsType == -1){
            $video = Video::find()
                ->orderBy(['datetime' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }else{
            $video = Video::find()
                ->where('sign=:sign', [':sign' => $newsType])
                ->orderBy(['datetime' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }
        $para = [];
        $para['video'] = Json::encode($video);
        $para['page'] = $page;
        $para['pageSize'] = $pagination->defaultPageSize;
        $para['totalCount'] = $pagination->totalCount;
        return Json::encode($para);
	}

    public function actionVideoDict(){
        $sign = Dictitem::find()->where(['dictCode'=>'DICT_SIGN'])->all();
        return Json::encode($sign);
    }
}

