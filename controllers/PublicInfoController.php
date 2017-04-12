<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\PublicInfo;
use app\models\Dictitem;
use app\models\InfoState;
use yii\data\Pagination;
use yii\helpers\Json;
use app\common\Common;

class PublicInfoController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * 显示信息管理页面
     * @return string
     */
    public function actionList()
    {
        return $this->render('list');
    }

    /**
     * @return string
     * 打开添加信息页面
     */
    public function actionAdd()
    {
        $state = Dictitem::find()->where(['dictCode' => 'DICT_PUBLICINFO_STATE'])->all();
        return $this->render('add',[
            'state'=>$state,
        ]);
    }

    /**
     * @return string
     * 添加一条信息
     */
    public function actionAddOne()
    {
        $publicInfo = new PublicInfo();
        $publicInfo->id = Common::create40ID();
        $publicInfo->title = Yii::$app->request->post('title');
        $publicInfo->content = Yii::$app->request->post('content');
        $publicInfo->author = Yii::$app->request->post('author');
        $publicInfo->category = Yii::$app->request->post('category');
        $publicInfo->state = Yii::$app->request->post('state');
        $publicInfo->attachUrl = Yii::$app->request->post('attachUrl');
        $publicInfo->attachName = Yii::$app->request->post('attachName');
        $publicInfo->picUrl = Yii::$app->request->post('picUrl');
        $publicInfo->published = date("Y-m-d H:i:s");

        $infoState = new InfoState();
        $infoState->id = Common::create40ID();
        $infoState->infoId = $publicInfo->id;
        $infoState->state = $publicInfo->state;
        $infoState->time = Yii::$app->request->post('datetime');

        if ($publicInfo->save()&&$infoState->save()) {
            return "success";
        } else {
            return "fail";
        }
    }

    /**
     * @return string
     * 打开信息修改页面
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $publicInfo = PublicInfo::findOne($id);
        $cateGory = Dictitem::find()->where(['dictCode' => 'DICT_CATEGORY'])->all();
        $state = Dictitem::find()->where(['dictCode' => 'DICT_PUBLICINFO_STATE'])->all();
        return $this->render('edit',[
            'publicInfo'=>$publicInfo,
            'cateGory'=>$cateGory,
            'state'=>$state,
        ]);
    }

    /**
     * @return string
     * 修改一条信息
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $attachUrl = Yii::$app->request->post('attachUrl');
        $picUrl = Yii::$app->request->post('picUrl');
        $publicInfo = PublicInfo::findOne($id);
        if($publicInfo->attachUrl != $attachUrl&&$publicInfo->attachUrl != ''&&$attachUrl!=''&&file_exists($publicInfo->attachUrl)){
            unlink($publicInfo->attachUrl );
        }
        if($attachUrl != '') {
            $publicInfo->attachUrl = $attachUrl;
            $publicInfo->attachName = Yii::$app->request->post('attachName');
        }
        if($publicInfo->picUrl != $picUrl&&$publicInfo->picUrl != ''&&$picUrl!=''&&file_exists($publicInfo->picUrl)){
            unlink($publicInfo->picUrl );
        }
        if($picUrl != '') {
            $publicInfo->picUrl = $picUrl;
        }
        $publicInfo->author = Yii::$app->request->post('author');
        $publicInfo->title = Yii::$app->request->post('title');
        $publicInfo->content = Yii::$app->request->post('content');
        $publicInfo->category = Yii::$app->request->post('category');



        if($publicInfo->save()) {
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除一条信息
     */
    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $publicInfo = PublicInfo::findOne($id);
        if($publicInfo->attachUrl !=''&&file_exists($publicInfo->attachUrl)) {
            unlink($publicInfo->attachUrl);
        }
        if($publicInfo->picUrl !=''&&file_exists($publicInfo->picUrl)) {
            unlink($publicInfo->picUrl);
        }
        if($publicInfo->delete()) {
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
            $publicInfo = PublicInfo::findOne($data);
            if($publicInfo->attachUrl != ''&&file_exists($publicInfo->attachUrl)) {
                unlink($publicInfo->attachUrl);
            }
            if($publicInfo->picUrl  != ''&&file_exists($publicInfo->picUrl)) {
                unlink($publicInfo->picUrl);
            }
            PublicInfo::deleteall('id=:id',[':id'=>$data]);
        }
        return "success";
    }

    /**
     * @return string
     * 打开信息的详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $publicInfo = PublicInfo::findOne($id);
        //字典反转
        $cateGory = Dictitem::find()->where(['dictCode'=>'DICT_CATEGORY'])->all();
        $state = Dictitem::find()->where(['dictCode'=>'DICT_PUBLICINFO_STATE'])->all();
        foreach ($cateGory as $index => $value) {
            if ($publicInfo->category == $value->dictItemCode) {
                $publicInfo->category = $value->dictItemName;
            }
        }
        foreach ($state as $index => $value) {
            if ($publicInfo->state == $value->dictItemCode) {
                $publicInfo->state = $value->dictItemName;
            }
        }
        return $this->render('detail',[
            'publicInfo'=>$publicInfo
        ]);
    }

    /**
     * 根据信息标题查询信息
     * @return string
     */
    public function actionFindByAttri(){
        $title = Yii::$app->request->get('title');
        $author = Yii::$app->request->get('author');
        $category = Yii::$app->request->get('category');

        $para = [];
        $para['title'] = $title;
        $para['author'] = $author;
        $para['category'] = $category;

        $whereStr = '1=1';
        if($title != ''){
            $whereStr = $whereStr . " and title like '%" . $title . "%'" ;
        }
        if($author != ''){
            $whereStr = $whereStr . " and author like '%" . $author . "%'" ;
        }
        if($category != ''){
            $whereStr = $whereStr . " and category like '%" . $category . "%'" ;
        }

        $publicInfo = PublicInfo::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $publicInfo->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $publicInfo->offset($page->offset)->limit($page->limit)->all();

        //字典反转
        $cateGory = Dictitem::find()->where(['dictCode'=>'DICT_CATEGORY'])->all();
        foreach($models as $key=>$data) {
            foreach ($cateGory as $index => $value) {
                if ($data->category == $value->dictItemCode) {
                    $models[$key]->category = $value->dictItemName;
                }
            }
        }
        return $this->render('listall',[
            'publicInfo' => $models,
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
     * @return string
     * 信息公开的接口
     */
    public function actionInfo(){
        $cat = Yii::$app->request->post('cat');
        $page = Yii::$app->request->post('page');
        if($cat == -1){
            $query = PublicInfo::find()
                ->count();
        }else{
            $query = PublicInfo::find()
                ->where('category=:category', [':category' => $cat])
                ->count();
        }
        $pagination = new Pagination([
            'page' => $page,
            'defaultPageSize' => 21,
            'validatePage' => false,
            'totalCount' => $query,
        ]);

        if($cat == -1) {
            $info = PublicInfo::find()
                ->select('title,published,id')
                ->orderBy(['published' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        }else{
            $info = PublicInfo::find()
                ->select('title,published,id')
                ->where('category=:category', [':category' => $cat])
                ->orderBy(['published' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }
        $para = [];
        $para['info'] = Json::encode($info);
        $para['page'] = $page;
        $para['pageSize'] = $pagination->defaultPageSize;
        $para['totalCount'] = $pagination->totalCount;
        return Json::encode($para);
    }
    /**
     * 获取有图片的信息
     */
    public function actionInfoOne(){
        $info = PublicInfo::find()
            ->select('title,published,picUrl,content,id')
            ->where('picUrl != ""')
            ->orderBy(['published' => SORT_DESC])
            ->limit(1)
            ->all();
        return Json::encode($info);
    }

    /**
     * @return string
     * 招标最新进展的接口
     */
    public function actionState(){
        $infoId = Yii::$app->request->post('id');
        $state = InfoState::find()
            ->select('state,time,id')
            ->where('infoId = :infoId',[':infoId'=>$infoId])
            ->orderBy(['state'=>SORT_ASC])
            ->all();
        return Json::encode($state);
    }
}