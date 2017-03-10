<?php

namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\CompanyNews;
use yii\data\Pagination;
use app\common\Common;

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
        $companyNews = CompanyNews::findOne($id);
        if($companyNews->attachUrl != $attachUrl&&$companyNews->attachUrl != ''&&$attachUrl !=''){
            unlink($companyNews->attachUrl );
        }
        $companyNews->attachUrl = $attachUrl;
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
        if($companyNews->attachUrl !='') {
            unlink($companyNews->attachUrl);
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
            if($companyNews->attachUrl !='') {
                unlink($companyNews->attachUrl);
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
}