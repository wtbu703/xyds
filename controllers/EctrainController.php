<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Ectrain;
use app\models\Dictitem;
use yii\data\Pagination;
use app\common\Common;

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

        $para = [];
        $para['name'] = $name;

        $whereStr = '1=1';
        if($name != ''){
            $whereStr = $whereStr . " and name like '%" . $name ."%'";
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
        $ectrain = Ectrain::findOne($id);
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
}



