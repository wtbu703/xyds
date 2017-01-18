<?php
/**
 * Created by PhpStorm.
 * User: liluoao
 * Date: 2017/1/18
 * Time: 18:38
 */
namespace app\controllers;

use yii;
use yii\base\Controller;
use app\common\Common;
use app\models\ServiceSite;
use app\models\ServiceSiteInfo;

/**
 * Class ServiceSiteController
 * @package app\controllers
 */
class ServiceSiteController extends Controller{

	/**
	 * 默认方法
	 * @return string
	 */
	public function actionIndex(){

		return $this->render('index');
	}

	/**
	 * 前往添加站点页
	 * @return string
	 */
	public function actionAdd(){

		return $this->render('add');
	}

	/**
	 * 上传站点照片
	 * @return string
	 */
	public function actionUpload(){

		if (Yii::$app->request->isPost) {

			$fileArg = Common::upload($_FILES,true,false);
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

	/**
	 * 保存信息到库
	 * @return string
	 */
	public function actionAddOne(){

		$serviceSite = new ServiceSite();
		$siteId = Common::create40ID();
		$serviceSite->id = $siteId;
		$serviceSite->code = Yii::$app->request->post('code');
		$serviceSite->name = Yii::$app->request->post('name');
		$serviceSite->countyType = Yii::$app->request->post('type');

		$serviceSiteInfo = new ServiceSiteInfo();
		$serviceSiteInfo->id = Common::create40ID();
		$serviceSiteInfo->siteId = $siteId;
		$serviceSiteInfo->chargeName = Yii::$app->request->post('chargeName');
		$serviceSiteInfo->chargeMobile = Yii::$app->request->post('chargeMobile');
		$serviceSiteInfo->address = Yii::$app->request->post('address');
		$serviceSiteInfo->picUrl = Yii::$app->request->post('attachUrls');

		if($serviceSite->save() && $serviceSiteInfo->save())
		{
			return "success";
		}
		else
		{
			return "fail";
		}
	}

	/**
	 * 检查站点编码是否重复
	 * @return string
	 */
	public function actionCheckCode(){

		$code = Yii::$app->request->get('code');
		$serviceSite = ServiceSite::find()
			->where(['code' => $code])
			->one();
		if(is_null($serviceSite))
		{
			return "success";
		}else
		{
			return "exist";
		}
	}
}