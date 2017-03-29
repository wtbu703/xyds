<?php
namespace app\controllers;

use yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Dictitem;
use app\common\Common;
use yii\data\Pagination;
use app\common\HtmlDom;
use app\common\Phpexcel;
use yii\helpers\Json;

/**
 * Class ArticleController
 * 文章管理控制器
 * @package app\controllers
 */
class ArticleController extends Controller{
   // public $layout = false;
    public $enableCsrfValidation = false;

	/**
	 * @return string
	 */
	public function actionList()
    {
        $add = Common::resource('ARTICLE','ADD');
        $excel = Common::resource('ARTICLE','EXCEL');
        return $this->render('list',[
            'add' => $add,
            'excel' => $excel
        ]);
    }

	/**
	 * @return string
	 */
	public function actionAdd()
    {
        return $this->render('add');
    }

    /**
     * 保存一篇文章到数据库
     * @return string
     */
    public function actionAddone(){

        $article = new Article();
        $article->id = Common::generateID();
        $article->title = Yii::$app->request->post('title');
        $article->author = Yii::$app->request->post('author');
        $article->keyword = Yii::$app->request->post('keyword');
        $article->content = Yii::$app->request->post('content');
        $article->category = Yii::$app->request->post('category');
        $article->attachUrls = Yii::$app->request->post('attachUrls');
        $article->attachNames = Yii::$app->request->post('attachNames');
        $article->picUrl = YIi::$app->request->post('picUrl');
        $article->sourceUrl = '本站';
        $article->datetime = date("Y-m-d H:i:s");

        if($article->save()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 根据条件查询多篇文章
     * @return string
     */
    public function actionFindbyattri(){

        $title = Yii::$app->request->get('title');
        $author = Yii::$app->request->get('author');
        $category = Yii::$app->request->get('category');
        $articledateTime_1 = Yii::$app->request->get('articledateTime_1');
        $articledateTime_2 = Yii::$app->request->get('articledateTime_2');

        $para = [];
        $para['title'] = $title;
        $para['author'] = $author;
        $para['category'] = $category;
        $para['articledateTime_1'] = $articledateTime_1;
        $para['articledateTime_2'] = $articledateTime_2;

        $whereStr = '1=1';
        if ($title != '') {
            $whereStr = $whereStr . " and title like '%" . $title . "%'";
        }
        if ($author != '') {
            $whereStr = $whereStr . " and author like '%" . $author . "%'";
        }
        if ($category != '') {
            $whereStr = $whereStr . " and category='" . $category ."'";
        }
        if($articledateTime_1 != ''){
            $whereStr = $whereStr." and datetime >= '".$articledateTime_1."%'";
        }
        if($articledateTime_2 != ''){
            $whereStr = $whereStr." and datetime <= '".$articledateTime_2."%'";
        }

        $articles = Article::find()->where($whereStr);
        $page = new Pagination(['totalCount' => $articles->count(), 'pageSize' => Common::PAGESIZE]);
        $models = $articles->offset($page->offset)->limit($page->limit)->all();

        $edit = Common::resource('ARTICLE','EDIT');
        $delete = Common::resource('ARTICLE','DELETE');
        return $this->render('listall',[
            'articles' => $models,
            'pages' => $page,
            'para' => $para,
            'edit' => $edit,
            'delete' => $delete
        ]);
    }

    /**
     * 根据ID前往修改页面
     * @return string
     */
    public function actionUpdate(){

        $id = Yii::$app->request->get('id');
        $article = Article::findOne($id);
        $cateGory = Dictitem::find()->where(['dictCode'=>'DICT_ARTICLE_CATEGORY'])->all();
        return $this->render('edit',[
            'article' => $article,
            'cateGory'=>$cateGory,
        ]);
    }

    /**
     * 根据ID修改一篇文章并保存到数据库
     * @return string
     */
    public function actionUpdateone(){

        $id = Yii::$app->request->post('id');
        $attachUrls = Yii::$app->request->post('attachUrls');
        $picUrl = Yii::$app->request->post('picUrl');
        $article = Article::findOne($id);
        if($article->attachUrls !=''&&$article->attachUrls != $attachUrls&&$attachUrls !=''&&file_exists($article->attachUrls) ){
            unlink($article->attachUrls);
        }
        if($attachUrls !=''){
            $article->attachUrls = $attachUrls;
            $article->attachNames = Yii::$app->request->post('attachNames');
        }
        if($article->picUrl !=''&&$article->picUrl != $picUrl&&$picUrl !=''&&file_exists($article->picUrl)){
            unlink($article->attachUrls);
        }
        if($picUrl !=''){
            $article->picUrl = $picUrl;
        }

        $article->category = Yii::$app->request->post('category');
        $article->title = Yii::$app->request->post('title');
        $article->author = Yii::$app->request->post('author');
        $article->content = Yii::$app->request->post('content');

        if ($article->save()){
            return 'success';
        }else{
            return 'fail';
        }
    }

    /**
     * 根据ID删除一篇文章
     * @return string
     */
    public function actionDeleteone(){

        $id = Yii::$app->request->post("id");
        $article = Article::findOne($id);
        if(!is_null($article->attachUrls)&&file_exists($article->attachUrls)){
            unlink($article->attachUrls);
        }
        if(!is_null($article->picUrl)&&file_exists($article->picUrl)){
            unlink($article->picUrl);
        }
        if($article->delete()){
            return "success";
        }else{
            return "fail";
        }
    }

    /**
     * 根据ID删除多篇文章
     * @return string
     */
    public function actionDeletemore(){

        $ids = Yii::$app->request->post("ids");
        $ids_array = explode('-',$ids);

        foreach($ids_array as $key => $data){
            $article = Article::findOne($data);
            if(!is_null($article->attachUrls)&&file_exists($article->attachUrls)){
                unlink($article->attachUrls);
            }
            if(!is_null($article->picUrl)&&file_exists($article->picUrl)){
                unlink($article->picUrl);
            }
            Article::deleteAll('id = :id',[':id'=>$data]);
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
        $article = Article::findOne($id);
        $cateGory = Dictitem::find()->where(['dictCode'=>'DICT_ARTICLE_CATEGORY'])->all();
        foreach ($cateGory as $index => $value) {
            if ($article->category == $value->dictItemCode) {
                $article->category = $value->dictItemName;
            }
        }
        return $this->render('detail',[
            'article'=>$article,
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
     * 文章抓取首页
     * @return string
     */
    public function actionCatchArticle(){
        return $this->render('catch');
    }

    /**
     * 抓取指定网站的数据
     */
    public function actionFindWebResource(){
	    /** @noinspection PhpMethodOrClassCallIsNotCaseSensitiveInspection */
	    $find_url = yii::$app->request->get('web');

        $title_array = [];
        $url_array = [];
        $datetime_array = [];
        $author_array = [];
        $content_array = [];


        $i = 0;

        if($find_url=='http://www.ceces.cn/'){
            $html = HtmlDom::file_get_html($find_url);
            do{
                $ret = $html->find('div[class=wrap mt20 clearfix] div[class=widget-bd clearfix] div[class=pt15 pb8 fYaHei clearfix] div[class=fl pro-ask] div[class=pl15 pr15 pb15] ul[class=pt30 ask-list] li a',$i);
                /*echo $ret->nodes[0]->_[4];
                echo "<br />";*/
                $title_array[$i] = $ret->nodes[0]->_[4];//文章标题
                $url = $ret->attr['href'];
                $url_array[$i] = $url;//链接地址
                $html2 = HtmlDom::file_get_html($find_url.$url);
                $ret2 = $html2->find('div[class=art-intro tc f14] span[class=gray]');
                $datetime_array[$i] = $ret2[0]->nodes[0]->_[4];//发布时间
                $ret3 = $html2->find('div[class=art-intro tc f14] span[class=ml15 gray]');
                $author_array[$i] = $ret3[0]->nodes[0]->_[4];//作者
	            /** @noinspection PhpUndefinedFieldInspection */
	            $content_start = mb_strpos($html2->plaintext,'上一篇') + mb_strlen('上一篇');
	            /** @noinspection PhpUndefinedFieldInspection */
	            $content_end = mb_strpos($html2->plaintext,'推荐新闻') - $content_start;
	            /** @noinspection PhpUndefinedFieldInspection */
	            $content_array[$i] = mb_substr($html2->plaintext,$content_start,$content_end);//文章内容

                $i++;
            }while(!is_null($html->find('div[class=wrap mt20 clearfix] div[class=widget-bd clearfix] div[class=pt15 pb8 fYaHei clearfix] div[class=fl pro-ask] div[class=pl15 pr15 pb15] ul[class=pt30 ask-list] li a',$i)));

        }elseif($find_url=='http://www.100ec.cn/'){
            $html = HtmlDom::file_get_html($find_url);
            do{
                $ret = $html->find('div[class=left] div[class=left01] div[class=mart1] div[class=cnews entry-content] ul li a',$i);
                $url = $ret->attr['href'];
                $url_array[$i] = $url;//链接地址
                $html2 = HtmlDom::file_get_html('http://www.100ec.cn'.$url);

	            /** @noinspection PhpUndefinedFieldInspection */
                $title_end = mb_strpos($html2->plaintext,'_中国电子商务研究中心');
	            /** @noinspection PhpUndefinedFieldInspection */
                $title_array[$i] = mb_substr($html2->plaintext,0,$title_end);
	            /** @noinspection PhpUndefinedFieldInspection */
                $datetime_start = mb_strpos($html2->plaintext,'http://www.100ec.cn&nbsp;&nbsp;') + mb_strlen('http://www.100ec.cn&nbsp;&nbsp;');
	            /** @noinspection PhpUndefinedFieldInspection */
                $datetime_end = mb_strpos($html2->plaintext,'&nbsp;&nbsp;中国电子商务研究中心')-$datetime_start;
	            /** @noinspection PhpUndefinedFieldInspection */
                $datetime_array[$i] = mb_substr($html2->plaintext,$datetime_start,$datetime_end);//时间
                $author_array[$i] = 'http://www.100ec.cn';//作者
	            /** @noinspection PhpUndefinedFieldInspection */
                $content_start = mb_strpos($html2->plaintext,'产品服务') + mb_strlen('产品服务');
	            /** @noinspection PhpUndefinedFieldInspection */
                $content_end = mb_strpos($html2->plaintext,'【独家专题】') - $content_start;
	            /** @noinspection PhpUndefinedFieldInspection */
                $content_array[$i] = mb_substr($html2->plaintext,$content_start,$content_end);//文章内容
                $i++;
            }while(!is_null($html->find('div[class=left] div[class=left01] div[class=mart1] div[class=cnews entry-content] ul li a',$i)) && $i<=10);

        }
        $num = 0;
        foreach($title_array as $key => $value){
            $article = new Article();
            $article->id = Common::generateID();
            $article->title = $value;
            $article->datetime = date("Y-m-d H:i:s");
            $article->author = $author_array[$key];
            $article->catchtime = $datetime_array[$key];
            $article->attachUrls = $url_array[$key];
            $article->content = strip_tags($content_array[$key]);
            $article->save();
            $num++;
        }
        $models = Article::find()->orderBy('datetime DESC')->limit($num)->all();

        return $this->render('result',[
            'articles' => $models
        ]);
    }

    /**
     * 文章预览页面
     * @return string
     */
    public function actionView(){
	    /** @noinspection PhpMethodOrClassCallIsNotCaseSensitiveInspection */
	    $id = yii::$app->request->get('id');
        $article = Article::findOne($id);

        return $this->render('view',[
            'article' => $article
        ]);
    }

    /**
     * 将抓取的文章存入数据库
     * @return string
     */
    public function actionAddMore(){
	    /** @noinspection PhpMethodOrClassCallIsNotCaseSensitiveInspection */
        $ids = yii::$app->request->post('ids');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key => $value){
            Article::deleteAll('id = :id',[":id"=>$value]);
        }
        return "success";
    }

    /**
     * 导出数据库数据为excel表
     */
    public function actionExcel(){
        Common::Excel(new Article());
    }

    /**
     * 导入excel表为数组
     */
    public function actionReadExcel(){
        $fromModel = Article::find()->all();
        $phpexcel = new Phpexcel($fromModel);
        $data = $phpexcel->ReadExcel('test.xlsx');
        print_r($data);exit;
    }

	/**
	 * 资讯接口
	 * @return string
	 */
	public function actionArticle(){
		$type = Yii::$app->request->post('newsType');
		$articles = Article::find()
			->where('category = :type',[":type"=>$type])
			->limit(13)
			->orderBy(['datetime'=>SORT_DESC])
			->all();
		return Json::encode($articles);
	}

}