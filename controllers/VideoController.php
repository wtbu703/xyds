<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Video;
use app\common\Common;
use yii\data\Pagination;

/**
 * Class VideoController
 * @package app\controllers
 */
class VideoController extends Controller
{
    public $layout = false;
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
        $state = Yii::$app->request->get('state');

        $para = [];
        $para['name'] = $name;
        $para['source'] = $source;
        $para['sign'] = $sign;
        $para['state'] = $state;

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
        if($state !=''){
            $whereStr = $whereStr . " and state=" . $state;
        }

        $videos = Video::find()->where($whereStr);
        $pages = new Pagination(['totalCount' => $videos->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $videos->offset($pages->offset)->limit($pages->limit)->all();

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
        if(Yii::$app->request->post('sign')==1) {
            $video = new Video();
            $video->id = Common::generateID();
            $video->sign = Yii::$app->request->post('sign');
            $video->source = Yii::$app->request->post('source');
            $video->datetime = date("Y-m-d H:i:s");
            $video->name = Yii::$app->request->post('name');
            $video->url = Yii::$app->request->post('url');
        }else {
            $video = new Video();
            $video->id = Common::generateID();
            $video->sign = Yii::$app->request->post('sign');
            $video->source = Yii::$app->request->post('source');
            $video->datetime = date("Y-m-d H:i:s");
            $video->url = Yii::$app->request->post('attachUrls');
            $video->name = Yii::$app->request->post('attachNames');
        }

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

    /**
     * 前往修改视频页面
     * @return string
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $video = Video::findOne($id);
        return $this->render('edit',[
            'video' => $video,
        ]);
    }

    /**
     * 根据ID修改一个视频并保存到数据库
     * @return string
     */
    public function actionUpdateone(){

        if(Yii::$app->request->post('sign')==1) {
            $id = Yii::$app->request->post('id');
            $video = Video::findOne($id);
            $video->sign = Yii::$app->request->post('sign');
            $video->source = Yii::$app->request->post('source');
            $video->name = Yii::$app->request->post('name');
            $video->url = Yii::$app->request->post('url');
        }else {
            $id = Yii::$app->request->post('id');
            $video = Video::findOne($id);
            $video->sign = Yii::$app->request->post('sign');
            $video->source = Yii::$app->request->post('source');
            $video->url = Yii::$app->request->post('attachUrls');
            $video->name = Yii::$app->request->post('attachNames');
        }

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

}

