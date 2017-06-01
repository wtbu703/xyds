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
        $article->sourceUrl = Yii::$app->request->post('sourceUrl');
        $article->keyword = Yii::$app->request->post('keyword');
        $article->content = Yii::$app->request->post('content');
        $article->category = Yii::$app->request->post('category');
        $article->attachUrls = Yii::$app->request->post('attachUrls');
        $article->attachNames = Yii::$app->request->post('attachNames');
        $article->picUrl = YIi::$app->request->post('picUrl');
        $article->sourceUrl = YIi::$app->request->post('sourceUrl');
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
        $models = $articles->offset($page->offset)->limit($page->limit)->orderBy(['datetime'=>SORT_DESC])->all();


        //字典反转
        $category = Dictitem::find()->where(['dictCode'=>'DICT_ARTICLE_CATEGORY'])->all();
        foreach($models as $key=>$data) {
            foreach ($category as $index => $value) {
                if ($data->category == $value->dictItemCode) {
                    $models[$key]->category = $value->dictItemName;
                }
            }
        }
/*        $edit = Common::resource('ARTICLE','UPDATE');
        $delete = Common::resource('ARTICLE','DELETEONE');*/
        return $this->render('listall',[
            'articles' => $models,
            'pages' => $page,
            'para' => $para,
      /*      'edit' => $edit,
            'delete' => $delete*/
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
            unlink($article->picUrl);
        }
        if($picUrl !=''){
            $article->picUrl = $picUrl;
        }

        $article->category = Yii::$app->request->post('category');
        $article->title = Yii::$app->request->post('title');
        $article->author = Yii::$app->request->post('author');
        $article->keyword = Yii::$app->request->post('keyword');
        $article->sourceUrl = Yii::$app->request->post('sourceUrl');
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

            $fileArg = Common::upload($_FILES,false,false,false,50*1024000);
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
                $fileArg = Common::upload($_FILES,true,false,'ecinfo_info',2048000
                );
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
	    $find_url = yii::$app->request->get('web');

        if($find_url != '') {
            $title_array = [];
            $datetime_array = [];
            $keyword_array = [];
            $author_array = [];
            $sourceUrl_array = [];
            $content_array = [];
            $picUrl_array = [];

            $i = 0;
            $data = file_get_contents("compress.zlib://" . $find_url);

            $p = '/<div class="indexList-left">
			    <div class="indexList-hover">
			    			    <a href="(.*?)" title=".*?" target="_blank">/';

            preg_match_all($p, $data, $matches);
            //将获取到的文章url数组赋给$url_array;
            $url_array = $matches[1];
            $len = count($url_array);
            do {

                $text = file_get_contents($url_array[$i]);
                $text = file_get_contents("compress.zlib://" . $url_array[$i]);

                $m = '/<h2>(.*?)<\/h2>/';
                preg_match($m, $text, $title);
                //print_r($title);
                $title1 = $title[1];
                //echo $title1.'</br></br></br></br>';
                $title_array[$i] = $title1;//标题

                $z = '/<i class="sprite i-times"><\/i><span>(.*?)<\/span><\/li>/';
                preg_match_all($z, $text, $time);
                //print_r($time);
                $time1 = $time[1];
                //echo $time1[0].'</br></br></br></br>';
                $datetime_array[$i] = $time1[0];//时间

                $x = '/ <a href=".*?" class="details-timeInfo">(.*?)<\/a>/';
                preg_match_all($x, $text, $keyword);
                //print_r($keyword);
                $keyword1 = $keyword[1];
                //echo $keyword1[0].'</br></br></br></br>';  //关键词
                $keyword_array[$i] = $keyword1[0];


                $n = '/<i class="sprite i-logos"><\/i><span>(.*?)<\/span><\/li>/';
                preg_match_all($n, $text, $author);
                //print_r($author);
                $author1 = $author[1];
                //echo $author1[0].'</br></br></br></br>'; //来源，作者
                $sourceUrl_array[$i] = $author1[0];

                $n = '/<div class="details-p">(.*?)<\/div>/ism';
                preg_match_all($n, $text, $content);
                //print_r($author);
                $content = $content[1];
                //echo $content[0].'</br></br></br></br>'; //内容
                $content_array[$i] = $content[0];

                $y = '/<p style="text-align:center"><img alt="" src="(.*?)"><\/p>/';
                preg_match_all($y, $text, $im);
                $img= $im[1];
                //print_r($im);
                //echo $img[0]."</br></br></br></br>";
                if(!empty($im[1])){
                    $imgs = file_get_contents($img[0]);
                    $img_array = explode('.',$img[0]);
                    $img_url = 'upload/articlePic/'. date("YmdHis") . mt_rand(10,99).'.'.$img_array[3];
                    file_put_contents($img_url,$imgs);
                    $imgurl = Common::resizes($img_url,750,510);
                    $picUrl_array[$i] = $imgurl;
                }

                $i = $i + 1;
            } while ($i < $len);

            $cou = Dictitem::find()->where(['dictCode' => 'DICT_ARTICLE_CATEGORY'])->count();
            $cou = $cou-1;
            $num = 0;
            foreach ($title_array as $key => $value) {
                $article = new Article();
                $article->id = Common::generateID();
                $article->title = $value;
                $article->datetime = date('Y-m-d H:m:s');
                //$article->catchtime = date('Y-m-d H:m:s');
                //$article->author = $author_array[$key];
                $article->sourceUrl = $sourceUrl_array[$key];
                $article->keyword = $keyword_array[$key];
                $article->content = $content_array[$key];
                if(!empty($picUrl_array[$key])) {
                    $article->picUrl = $picUrl_array[$key];
                }
                $article->category = rand(0, $cou);
                $article->catchState = 0;
                $article->save();
                $num++;
            }

        }
        $models = Article::find()->orderBy('datetime DESC')->where('catchState = 0')->all();
        foreach($models as $key=>$data){
            if($data->catchState == '0'){
                $models[$key]->catchState = '未添加';
            }
        }
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
        $sid = yii::$app->request->post('sid');
        $ids_array = explode('-',$ids);
        foreach($ids_array as $key => $value){
            Article::deleteAll('id = :id',[":id"=>$value]);
        }
        if($sid != ''){
            $sid_array = explode('-',$sid);
            foreach($sid_array as $key => $value){
                $article = Article::findOne($value);
                $article->catchState = 1;
                $article->save();
            }
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
     * @return string
     * 首页电商资讯的接口
     */
    public function actionIndexArticle(){
        $type = Yii::$app->request->post('newsType');
        $type = $type-1;
        $article = Article::find()
            ->select('id,title,content,datetime,picUrl')
            ->where('category = :category',[':category'=>$type])
            ->orderBy(['datetime' => SORT_DESC])
            ->limit(13)
            ->all();
        return Json::encode($article);
    }
	/**
	 * 资讯接口
	 * @return string
	 */
	public function actionArticle(){
		$type = Yii::$app->request->post('newsType');
        $type = $type-1;
        $page = Yii::$app->request->post('page');
        if($type == -1){
            $query = Article::find()
                ->count();
        }else{
            $query = Article::find()
                ->where('category=:category', [':category' => $type])
                ->count();
        }
        $pagination = new Pagination([
            'page' => $page,
            'defaultPageSize' => 10,
            'validatePage' => false,
            'totalCount' => $query,
        ]);
        if($type == -1) {
            $article = Article::find()
                ->select('title,datetime,id,content,picUrl')
                ->orderBy(['datetime' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

        }else{
            $article = Article::find()
                ->select('title,datetime,id,content,picUrl')
                ->where('category=:category', [':category' => $type])
                ->orderBy(['datetime' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }
        $para = [];
        $para['article'] = Json::encode($article);
        $para['page'] = $page;
        $para['pageSize'] = $pagination->defaultPageSize;
        $para['totalCount'] = $pagination->totalCount;
        return Json::encode($para);
	}

	/**
	 * 右侧热点新闻接口
	 * @return string
	 */
	public function actionHotNews(){
		$article = Article::find()
			->orderBy(['count'=>SORT_DESC])
			->limit(7)
			->all();
		return Json::encode($article);
	}

    /**
     * @return string
     * 资讯类别字典接口
     */
    public function actionIndexDict(){
        $category = Dictitem::find()->where(['dictCode'=>'DICT_ARTICLE_CATEGORY'])->all();
        return Json::encode($category);
    }
}