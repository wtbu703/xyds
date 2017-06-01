<?php
namespace app\controllers;

use app\models\EctrainEnter;
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
        $ectrain->thumbnailUrl = Yii::$app->request->post('thumbnailUrl');
        $ectrain->beginTime = Yii::$app->request->post('beginTime');
        $ectrain->endTime = Yii::$app->request->post('endTime');
        $ectrain->time = Yii::$app->request->post('time');
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
        $ectraindateTime_1 = Yii::$app->request->get('ectraindateTime_1');
        $ectraindateTime_2 = Yii::$app->request->get('ectraindateTime_2');

        $para = [];
        $para['name'] = $name;
        $para['category'] = $category;
        $para['ectraindateTime_1'] = $ectraindateTime_1;
        $para['ectraindateTime_2'] = $ectraindateTime_2;

        $whereStr = '1=1';
        if($name != ''){
            $whereStr = $whereStr . " and name like '%" . $name ."%'";
        }
        if ($category != '') {
            $whereStr = $whereStr . " and category like '%" . $category . "%'";
        }
        if($ectraindateTime_1 != ''){
            $whereStr = $whereStr." and published >= '".$ectraindateTime_1."%'";
        }
        if($ectraindateTime_2 != ''){
            $whereStr = $whereStr." and published <= '".$ectraindateTime_2."%'";
        }
        $ectrain = Ectrain::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $ectrain->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $ectrain->offset($page->offset)->limit($page->limit)->orderBy(['published'=>SORT_DESC])->all();

        $category = Dictitem::find()
            ->where(['dictCode' => 'DICT_ECTRAIN_CATEGORY'])
            ->all();
        $people = [];
        foreach($models as $key=>$data){
            foreach($category as $index=>$value){
                if($data->category == $value->dictItemCode){
                    $models[$key]->category = $value->dictItemName;
                }
            }
            $people[$key] = EctrainEnter::find()->where('trainId=:id',[':id'=>$models[$key]->id])->count();
        }
        return $this->render('listall',[
            'ectrain'=>$models,
            'people'=>$people,
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
        if($ectrain->thumbnailUrl != $thumbnailUrl&&$ectrain->thumbnailUrl != ''&&$thumbnailUrl !=''&&file_exists($ectrain->thumbnailUrl)){
            unlink($ectrain->thumbnailUrl );
        }
        if($thumbnailUrl != ''){
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
        $ectrain->beginTime = Yii::$app->request->post('beginTime');
        $ectrain->endTime = Yii::$app->request->post('endTime');
        $ectrain->time = Yii::$app->request->post('time');

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
        if(is_null($ectrain->thumbnailUrl)&&file_exists($ectrain->thumbnailUrl)){
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
            if($ectrain->thumbnailUrl !=''&&file_exists($ectrain->thumbnailUrl)) {
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
        $peo = EctrainEnter::find()->where('trainId=:id',[':id'=>$ectrain->id])->count();
        return $this->render('detail',[
            'ectrain'=>$ectrain,
            'peo'=>$peo,
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
                $fileArg = Common::upload($_FILES,true,false,'index_ectrain',2*1024000);
            }else{
                $fileArg = Common::upload($_FILES,true,true,'index_ectrain',2*1024000);
                $views = 'upload';
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
            return $this->render('upload',[
                "tag" => "empty",
                "fileArg" =>[
                    "fileSaveUrl" =>"",//上传文件保存的路径
                    "tag" => "",//当为success表示上传成功，当为error时表示文件过大或是文件类型不对
                ],
            ]);
        }
    }

	/**
	 * 培训通知接口
	 * @return string
	 */
	public function actionEctrain(){
        $type = Yii::$app->request->post('newsType');
        $type = $type-1;
        $page = Yii::$app->request->post('page');
        if($type == -1){
            $query = Ectrain::find()
                ->count();
        }else{
            $query = Ectrain::find()
                ->where('category=:category', [':category' => $type])
                ->count();
        }
        $pagination = new Pagination([
            'page' => $page,
            'defaultPageSize' => 6,
            'validatePage' => false,
            'totalCount' => $query,
        ]);
        if($type == -1) {
            $ectrain = Ectrain::find()
                ->orderBy(['published' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        }else{
            $ectrain = Ectrain::find()
                ->where('category=:category', [':category' => $type])
                ->orderBy(['published' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }
        $peopleNum = [];
        foreach($ectrain as $key=>$data) {
            $peopleNum[$key] = EctrainEnter::find()
                ->where('trainId = :trainId', [':trainId' => $ectrain[$key]->id])
                ->count();
        }

        $para = [];
        $para['ectrain'] = Json::encode($ectrain);
        $para['page'] = $page;
        $para['pageSize'] = $pagination->defaultPageSize;
        $para['totalCount'] = $pagination->totalCount;
        $para['peopleNum'] = $peopleNum;
        return Json::encode($para);
    }

	/**
	 * 培训页接口
	 * @return string
	 */
	public function actionEctrainAll(){
		$ectrain = Ectrain::find()
			->orderBy(['published'=>SORT_DESC])
			->limit(9)
			->all();
		return Json::encode($ectrain);
	}

	/**
	 * 培训分类接口
	 * @return string
	 */
	public function actionDict(){
		$dictitems = Dictitem::find()
			->where([
				'state' => '1',
				'dictCode' => 'DICT_ECTRAIN_CATEGORY',
			])
			->orderBy('orderBy')
			->all();
		return Json::encode($dictitems);
	}
    /**
     * @return string
     * 首页3条有图的电商培训
     */
    public function actionEctrainIndex(){
        $ectrain = Ectrain::find()
            ->where('thumbnailUrl != ""')
            ->orderBy(['published'=> SORT_DESC])
            ->limit(3)
            ->all();
        return Json::encode($ectrain);
    }

    /**
     * @return string
     * 首页4个热门培训分类的接口
     */
    public function actionEcCategory(){
        $category = Dictitem::find()
            ->where([
                'state' => '1',
                'dictCode' => 'DICT_ECTRAIN_CATEGORY',
            ])
            ->orderBy(['dictItemCode' => SORT_ASC])
            ->all();
        $len = Dictitem::find()
            ->where([
                'state' => '1',
                'dictCode' => 'DICT_ECTRAIN_CATEGORY',
            ])
            ->count();
        for ($i = 0; $i < $len; $i++) {
            $para[$i] = Ectrain::find()
                ->where('category = :category', [':category' => $category[$i]->dictItemCode])
                ->count();
            $cateCode[$i] = $category[$i]->dictItemCode;
            $cateName[$i] = $category[$i]->dictItemName;
        }
        for ($j = 0; $j < $len; $j++) {
            for ($i = 0; $i < $len - 1 - $j; $i++)
            {
                if ($para[$i] < $para[$i + 1])
                {
                    $t = $para[$i];
                    $para[$i] = $para[$i + 1];
                    $para[$i + 1] = $t;

                    $m = $cateName[$i];
                    $cateName[$i] = $cateName[$i + 1];
                    $cateName[$i + 1] = $m;
                }
            }
        }
        return Json::encode($cateName);
    }
}



