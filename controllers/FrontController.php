<?php
/**
 * Author: luoao,li
 * Date: 2017/3/30
 * Time: 11:26
 * Function:
 */

namespace app\controllers;

use app\models\Company;
use app\models\ThirdPartyService;
use app\models\CompanyRecruit;
use yii;
use yii\web\Controller;

class FrontController extends Controller{
	public $layout = "common";

	/**
	 * 首页
	 * @return string
	 */
	public function actionIndex(){
		return $this->render('index');
	}

	/**
	 * 登录
	 */
	public function actionLogin(){
		return $this->render('login');
	}

	/**
	 * 注册
	 */
	public function actionRegist(){
		return $this->render('regist');
	}

	/**
	 * 加入我们
	 */
	public function actionContactus(){
		return $this->render('contactus');
	}



	/**
	 * 企业展示页
	 * @return string
	 */
	public function actionEnterpriseDisplay(){
		return $this->render('enterprisedisplay');
	}

	public function actionEnterpriseDetail(){
		//var_dump('1');
		$companyId = Yii::$app->request->get('id');
		$company = Company::findOne($companyId);
		$companyDetail = yii\helpers\Json::encode($company);
		return $this->render('enterprisedetail',[
			'companyDetail' => $companyDetail,
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
	 * @return string
	 * 在线招聘
	 */
	public function actionLine(){
		return $this->render('online');
	}
	/**
	 * @return string
	 * 在线招聘详情页
	 */
	public function actionDetail(){
		$id = Yii::$app->request->get('id');
		$companyRecruit = CompanyRecruit::findOne($id);
		return $this->render('onDetail',[
			'companyRecruit'=>$companyRecruit,
		]);
	}
}
