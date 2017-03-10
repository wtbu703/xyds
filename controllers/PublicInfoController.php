<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\PublicInfo;
use app\models\Dictitem;
use yii\data\Pagination;
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
        return $this->render('add');
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
        $publicInfo->published = date("Y-m-d H:i:s");

        if ($publicInfo->save()) {
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
        $publicInfo = PublicInfo::findOne($id);
        if($publicInfo->attachUrl != $attachUrl&&$publicInfo->attachUrl != ''&&$attachUrl!=''){
            unlink($publicInfo->attachUrl );
        }
        $publicInfo->attachUrl = $attachUrl;
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
        if($publicInfo->attachUrl !='') {
            unlink($publicInfo->attachUrl);
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
            if($publicInfo->attachUrl) {
                unlink($publicInfo->attachUrl);
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
        foreach ($cateGory as $index => $value) {
            if ($publicInfo->category == $value->dictItemCode) {
                $publicInfo->category = $value->dictItemName;
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
}