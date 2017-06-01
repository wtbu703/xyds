<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Contact;
use yii\data\Pagination;
use app\common\Common;

class ContactController extends Controller{
    public $enableCsrfValidation = false;

    /**
     * @return string
     * 打开联系信息管理页面
     */
    public function actionList(){
        return $this->render('list');
    }

    /**
     * @return string
     * 打开添加联系信息页面
     */
    public function actionAdd(){
        return $this->render('add');
    }

    /**
     * @return string
     * 添加一条联系信息
     */
    public function actionAddOne(){
        $contact = new Contact();
        $contact->id = Common::create40ID();
        $contact->truename = Yii::$app->request->post('truename');
        $contact->gender = Yii::$app->request->post('gender');
        $contact->mobile = Yii::$app->request->post('mobile');
        $contact->QQ = Yii::$app->request->post('QQ');
        $contact->email = Yii::$app->request->post('email');
        $contact->content = Yii::$app->request->post('content');

        if($contact->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 查询多条联系信息
     */
    public function actionFindByAttri(){
        $truename = Yii::$app->request->get('truename');

        $para = [];
        $para['truename'] = $truename;

        $whereStr = '1=1';
        if($truename != ''){
            $whereStr = $whereStr . " and truename like '%" . $truename ."%'";
        }
        $contact = Contact::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $contact->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $contact->offset($page->offset)->limit($page->limit)->orderBy(['datetime'=>SORT_DESC])->all();

        return $this->render('listall',[
            'contact'=>$models,
            'pages' => $page,
            'para' => $para,
        ]);
    }

    /**
     * @return string
     * 打开联系信息修改页面
     */
    public function actionUpdate(){
        $id = Yii::$app->request->get('id');
        $contact = Contact::findOne($id);
        return $this->render('edit',[
            'contact'=>$contact,
        ]);
    }

    /**
     * @return string
     * 修改一条记录
     */
    public function actionUpdateOne(){
        $id = Yii::$app->request->post('id');
        $contact = Contact::findOne($id);
        $contact->truename = Yii::$app->request->post('truename');
        $contact->gender = Yii::$app->request->post('gender');
        $contact->mobile = Yii::$app->request->post('mobile');
        $contact->QQ = Yii::$app->request->post('QQ');
        $contact->email = Yii::$app->request->post('email');
        $contact->content = Yii::$app->request->post('content');

        if($contact->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除一条联系信息
     */
    public function actionDeleteOne(){
        $id = Yii::$app->request->post('id');
        $contact = Contact::findOne($id);

        if($contact->delete()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * @return string
     * 删除多条记录
     */
    public function actionDeleteMore(){
        $ids = Yii::$app->request->post('ids');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key=>$data){
            Contact::deleteall('id=:id',[':id'=>$data]);
        }
    }

    /**
     * @return string
     * 打开联系信息详情页面
     */
    public function actionFindOne(){
        $id = Yii::$app->request->get('id');
        $contact = Contact::findOne($id);
        return $this->render('detail',[
            'contact'=>$contact
        ]);
    }
}



