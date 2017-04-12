<?php
/**
 * Author: luoao,li
 * Date: 2017/3/30
 * Time: 11:26
 * Function:
 */

namespace app\controllers;

use app\models\Article;
use app\models\CompanyNews;
use app\models\Company;
use app\models\CompanyProduct;
use app\models\Contact;
use app\models\ThirdPartyService;
use app\models\CompanyRecruit;
use app\models\Ectrain;
use app\models\EctrainEnter;
use app\models\PublicInfo;
use app\models\Video;
use yii;
use yii\web\Controller;
use app\common\Common;
use yii\data\Pagination;
use yii\helpers\Json;

class FrontController extends Controller{
	public $layout = "common";
	public $enableCsrfValidation = false;

	/**
	 * 首页
	 * @return string
	 */
	public function actionIndex(){
		return $this->render('index');
	}

	/**
	 * @return string
	 * 加入我们
	 */
	public function actionContactus(){
		return $this->render('contactus');
	}

	/**
	 * @return string
	 * 提交联系我们信息
	 */
	public function actionConAdd(){
		$contact = new Contact();
		$contact->id = Common::create40ID();
		$contact->gender = Yii::$app->request->post('gender');
		$contact->truename = Yii::$app->request->post('name');
		$contact->mobile = Yii::$app->request->post('mobile');
		$contact->email = Yii::$app->request->post('email');
		$contact->QQ = Yii::$app->request->post('QQ');
		$contact->content = Yii::$app->request->post('content');
		$contact->datetime = date('Y-m-d H:i:s');
		if($contact->save()) {
			return 'success';
		}else{
			return 'fail';
		}
	}

	/**
	 * 企业展示页
	 * @return string
	 */
	public function actionEnterpriseDisplay(){
		return $this->render('enterprisedisplay');
	}

	/**
	 * 获取企业ID并前往详情页
	 * @return string
	 */
	public function actionEnterpriseDetail(){
		$companyId = Yii::$app->request->get('id');
		$company = Company::findOne($companyId);
		return $this->render('enterprisedetail',[
			'company' => $company,
			'companyId' => $companyId
		]);
	}

	/**
	 * 第三方服务
	 * @return string
	 */
	public function actionThird(){
		return $this->render('third');
	}

	/**
	 * 第三方服务详情
	 * @return string
	 */
	public function actionThirdDetail(){
		$id = Yii::$app->request->get('id');
		$thirdDetail = ThirdPartyService::findOne($id);
		$thirdDetail->count = $thirdDetail->count+1;
		$thirdDetail->save();
		return $this->render('thirddetail',[
			'thirdDetail'=>$thirdDetail,
		]);
	}

	/**
	 * 在线招聘
	 * @return string
	 */
	public function actionLine(){
		return $this->render('online');
	}

	/**
	 * 在线招聘详情页
	 * @return string
	 */
	public function actionDetail(){
		$id = Yii::$app->request->get('id');
		$companyId = Yii::$app->request->get('companyId');
		$company = Company::findOne($companyId);
		$companyRecruit = CompanyRecruit::findOne($id);
		return $this->render('onDetail',[
			'companyRecruit'=>$companyRecruit,
			'company'=>$company,
		]);
	}

	/**
	 * 打开信息公开页面
	 * @return string
	 */
	public function actionPublicInfo(){
		return $this->render('info');
	}

	/**
	 * 信息公开详情页
	 * @return string
	 */
	public function actionInfoDetail(){
		$id = Yii::$app->request->get('id');
		$info = PublicInfo::findOne($id);
		$sinfo = PublicInfo::find()
				->orderBy(['published'=>SORT_ASC])
				->where('published>:time',[':time'=>$info->published])
				->limit('0,1')
				->one();
		$infos = PublicInfo::find()
				->orderBy(['published'=>SORT_DESC])
				->where('published<:time',[':time'=>$info->published])
				->limit('0,1')
				->one();
		return $this->render('infodetail',[
				'info'=>$info,
				'sid'=>$sinfo->id,
				'ids'=>$infos->id,
				'stitle'=>$sinfo->title,
				'titles'=>$infos->title,
				'spublished'=>$sinfo->published,
				'publisheds'=>$infos->published,
		]);
	}

	/**
	 * 电商培训页
	 * @return string
	 */
	public function actionEctrain(){
		return $this->render('ectrain');
	}

	/**
	 * 电商培训通知页
	 * @return string
	 */
	public function actionTrainNotice(){
		return $this->render('trainnotice');
	}

	/**
	 * 电商培训详情页
	 * @return string
	 */
	public function actionTrainDetail(){
		$ectrainId = Yii::$app->request->get('id');
		$ectrain = Ectrain::findOne($ectrainId);
		return $this->render('traindetail',[
			'ectrain' => $ectrain
		]);
	}

	/**
	 * 在线视频页
	 * @return string
	 */
	public function actionOnlineVideo(){
		return $this->render('onlinevideo');
	}

	/**
	 * 在线视频详情页
	 * @return string
	 */
	public function actionVideoDetail(){
		$videoId = Yii::$app->request->get('videoId');
		$video = Video::findOne($videoId);
		return $this->render('videodetail',[
			'video' => $video
		]);
	}

	/**
	 * 企业产品
	 * @return string
	 */
	public function actionProductDisplay(){
		$companyId = Yii::$app->request->get('id');
		return $this->render('productdisplay',[
			'companyId' => $companyId
		]);
	}

	/**
	 * 企业产品详情
	 * @return string
	 */
	public function actionProductDetail(){
		$productId = Yii::$app->request->get('productId');
		$product = CompanyProduct::findOne($productId);
		return $this->render('productdetail',[
			'product' => $product
		]);
	}

	/**
	 * 电商资讯
	 * @return string
	 */
	public function actionEcInfo(){
		return $this->render('ecinformation');
	}

	/**
	 * 电商资讯详情
	 * @return string
	 */
	public function actionEcInfoDetail(){
		$articleId = Yii::$app->request->get('articleId');
		$article = Article::findOne($articleId);
		$sarticle = Article::find()
				->orderBy(['datetime'=>SORT_ASC])
				->where('datetime>:time',[':time'=>$article->datetime])
				->limit('0,1')
				->one();
		$articles = Article::find()
				->orderBy(['datetime'=>SORT_DESC])
				->where('datetime<:time',[':time'=>$article->datetime])
				->limit('0,1')
				->one();

		return $this->render('ecinformationdetail',[
			'article' => $article,
			'sid'=>$sarticle->id,
			'ids'=>$articles->id,
			'stitle'=>$sarticle->title,
			'titles'=>$articles->title,
			'sdatetime'=>$sarticle->datetime,
			'datetimes'=>$articles->datetime,
		]);
	}

	/**
	 * @return string
	 * 搜索
	 */
	public function actionSearch(){
		$title = Yii::$app->request->get('title');
		return $this->render('search',[
				'title'=>$title,
		]);
	}

	/**
	 * @return string
	 * 加载搜索信息，并实现分页
	 */
	public function actionFindMore(){
		$title = Yii::$app->request->post('title');
		$page = Yii::$app->request->post('page');
		$whereStr = " title like '%" . $title . "%'";
		$query = Article::find()
				->where($whereStr)
				->count();


		$pagination = new Pagination([
				'page' => $page,
				'defaultPageSize' => 10,
				'validatePage' => false,
				'totalCount' => $query,
		]);

		$sea = Article::find()
				->select('title,datetime,id,author,category,keyword,content')
				->where($whereStr)
				->orderBy(['datetime' => SORT_DESC])
				->offset($pagination->offset)
				->limit($pagination->limit)
				->all();

		$para = [];
		$para['sea'] = Json::encode($sea);
		$para['page'] = $page;
		$para['pageSize'] = $pagination->defaultPageSize;//一页的条数
		$para['totalCount'] = $pagination->totalCount; //总条数
		return Json::encode($para);
	}
	/**
	 * 企业新闻页
	 * @return string
	 */
	public function actionCompanyNews(){
		$companyId = Yii::$app->request->get('companyId');
		return $this->render('companynews',[
				'companyId' => $companyId
		]);
	}

	/**
	 * 企业新闻详情页
	 * @return string
	 */
	public function actionNewsDetail(){
		$newsId = Yii::$app->request->get('newsId');
		$companyId = Yii::$app->request->get('companyId');
		$companyNews = CompanyNews::findOne($newsId);
		return $this->render('newsdetail',[
				'companyNews' => $companyNews,
				'companyId' => $companyId
		]);
	}

	/**
	 * @return string
	 * 打开培训报名页面
	 */
	public function actionSignup(){
		$trainId = Yii::$app->request->get('id');
		return $this->render('signup',[
			'trainId'=>$trainId,
		]);
	}
	/**
	 * @return string
	 * 培训报名
	 */
	public function actionSign(){
		$ectrainEnter = new EctrainEnter();
		$ectrainEnter->id = Common::create40ID();
		$ectrainEnter->truename = Yii::$app->request->post('name');
		$ectrainEnter->trainId = Yii::$app->request->post('trainId');
		$ectrainEnter->gender  = Yii::$app->request->post('gender');
		$ectrainEnter->age  = Yii::$app->request->post('age');
		$ectrainEnter->mobile  = Yii::$app->request->post('mobile');
		$ectrainEnter->address  = Yii::$app->request->post('address');
		$ectrainEnter->idCardNo  = Yii::$app->request->post('idCardNo');
		$ectrainEnter->created = date('Y-m-d H:i:s');
		if($ectrainEnter->save()){
			return "success";
		}else{
			return "fail";
		}
	}

	/**
	 * 数据统计页
	 * @return string
	 */
	public function actionDataStatistic(){
		return $this->render('statistic');
	}
}
