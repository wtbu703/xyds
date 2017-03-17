<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Ectrain;
use app\models\Dictitem;
use yii\data\Pagination;
use app\common\Common;
use yii\helpers\Json;

class EctrainController extends Controller{
    public $enableCsrfValidation = false;

    /**
     * @return string
     * 打开培训管理页面
     */
    public function actionList(){
        return $this->render('list');
    }

    /**
     * @return string
     * 打开添加培训页面
     */
    public function actionAdd(){
        return $this->render('add');
    }

    /**
     * @return string
     * 添加一个培训
     */
    public function actionAddOne(){
        $ectrain = new Ectrain();
        $ectrain->id = Common::create40ID();
        $ectrain->name = Yii::$app->request->post('name');
        $ectrain->category = Yii::$app->request->post('category');
        $ectrain->content = Yii::$app->request->post('content');
        $ectrain->dayNum = Yii::$app->request->post('dayNum');
        $ectrain->period = Yii::$app->request->post('period');
        $ectrain->peopleNum = Yii::$app->request->post('peopleNum');
        $ectrain->target = Yii::$app->request->post('target');
        $ectrain->publisher = Yii::$app->request->post('publisher');
        $ectrain->picUrl = Yii::$app->request->post('picUrl');
        $ectrain->thumbnailUrl = Yii::$app->request->post('thumbnailUrl');
        $ectrain->published = date("Y-m-d H:i:s");

        if($ectrain->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 查询多个培训
     */
    public function actionFindByAttri(){
        $name = Yii::$app->request->get('name');
        $category = Yii::$app->request->get('category');
        $period = Yii::$app->request->get('period');
        $ectraindateTime_1 = Yii::$app->request->get('ectraindateTime_1');
        $ectraindateTime_2 = Yii::$app->request->get('ectraindateTime_2');

        $para = [];
        $para['name'] = $name;
        $para['category'] = $category;
        $para['period'] = $period;
        $para['ectraindateTime_1'] = $ectraindateTime_1;
        $para['ectraindateTime_2'] = $ectraindateTime_2;

        $whereStr = '1=1';
        if($name != ''){
            $whereStr = $whereStr . " and name like '%" . $name ."%'";
        }
        if ($category != '') {
            $whereStr = $whereStr . " and category like '%" . $category . "%'";
        }
        if ($period != '') {
            $whereStr = $whereStr . " and period='" . $period ."'";
        }
        if($ectraindateTime_1 != ''){
            $whereStr = $whereStr." and datetime >= '".$ectraindateTime_1."%'";
        }
        if($ectraindateTime_2 != ''){
            $whereStr = $whereStr." and datetime <= '".$ectraindateTime_2."%'";
        }
        $ectrain = Ectrain::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $ectrain->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $ectrain->offset($page->offset)->limit($page->limit)->all();

        return $this->render('listall',[
            'ectrain'=>$models,
            'pages' => $page,
            'para' => $para,
        ]);
    }

    /**
     * @return string
     * 打开培训修改页面
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $ectrain = Ectrain::findOne($id);
        $categorydict = Dictitem::find()->where(['dictCode' => 'DICT_ECTRAIN_CATEGORY'])->all();
        $perioddict = Dictitem::find()->where(['dictCode' => 'DICT_PERIOD'])->all();
        return $this->render('edit',[
            'ectrain'=>$ectrain,
            'categorydict'=>$categorydict,
            'perioddict'=>$perioddict,

        ]);
    }

    /**
     * @return string
     * 修改一个培训
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $picUrl = Yii::$app->request->post('picUrl');
        $thumbnailUrl = Yii::$app->request->post('thumbnailUrl');
        $ectrain = Ectrain::findOne($id);
        if($ectrain->picUrl != $picUrl&&$ectrain->picUrl !=''&&$picUrl !=''){
            unlink($ectrain->picUrl);
            $ectrain->picUrl = $picUrl;
        }
        if($ectrain->thumbnailUrl != $thumbnailUrl&&$ectrain->thumbnailUrl != ''&&$thumbnailUrl !=''){
            unlink($ectrain->thumbnailUrl );
            $ectrain->thumbnailUrl =$thumbnailUrl;
        }
        $ectrain->name = Yii::$app->request->post('name');
        $ectrain->category = Yii::$app->request->post('category');
        $ectrain->content = Yii::$app->request->post('content');
        $ectrain->dayNum = Yii::$app->request->post('dayNum');
        $ectrain->period = Yii::$app->request->post('period');
        $ectrain->peopleNum = Yii::$app->request->post('peopleNum');
        $ectrain->target = Yii::$app->request->post('target');
        $ectrain->publisher = Yii::$app->request->post('publisher');

        if($ectrain->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除一个培训
     */
    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $ectrain = Ectrain::findOne($id);
        if(is_null($ectrain->picUrl)){
            unlink($ectrain->picUrl);
        }
        if(is_null($ectrain->thumbnailUrl)){
            unlink($ectrain->thumbnailUrl );
        }

        if($ectrain->delete()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除多个培训
     */
    public function actionDeleteMore(){
        $ids = Yii::$app->request->post('ids');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key=>$data){
            $ectrain = Ectrain::findOne($data);
            if($ectrain->picUrl !='') {
                unlink($ectrain->picUrl);
            }
            if($ectrain->thumbnailUrl !='') {
                unlink($ectrain->thumbnailUrl);
            }
            Ectrain::deleteall('id=:id',[':id'=>$data]);
        }
    }

    /**
     * @return string
     * 打开培训详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $ectrain = Ectrain::findOne($id);
        $categorydict = Dictitem::find()->where(['dictCode'=>'DICT_ECTRAIN_CATEGORY'])->all();
        $period = Dictitem::find()->where(['dictCode'=>'DICT_PERIOD'])->all();
        foreach ($categorydict as $index => $value) {
            if ($ectrain->category == $value->dictItemCode) {
                $ectrain->category = $value->dictItemName;
            }
        }
        foreach ($period as $index => $value) {
            if ($ectrain->period == $value->dictItemCode) {
                $ectrain->period = $value->dictItemName;
            }
        }
        return $this->render('detail',[
            'ectrain'=>$ectrain
        ]);
    }

    /*
     * 上传
     */
    public function actionUpload(){
        //实现上传
        if (Yii::$app->request->isPost) {
            $isThumb = Yii::$app->request->get('isThumb');
            $views = 'upload';
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
            return $this->render('upload',[
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

    public function actionUploadss(){
        //实现上传
        if (Yii::$app->request->isPost) {
            $isThumb = Yii::$app->request->get('isThumb');
            $views = 'upload';
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
            return $this->render('upload',[
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

    public function actionEctrain(){
        $ectrain = Ectrain::find()->all();
        return Json::encode($ectrain);
    }
}



