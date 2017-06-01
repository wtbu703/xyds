<?php

namespace app\common;

use Yii;
use yii\db\Query;


/**
 * Class Common
 * @package app\common
 */
class Common
{
    /**
     * 加密密码
     * @param $password
     * @return string
     */
    public static function hashMD5($password){
        return sha1($password,false);
    }

    /**
     * 生成唯一ID
     * @return mixed
     */
    public static function generateID(){
        return str_replace('.','zsyj',uniqid('zsyj',true));
    }

	/**
	 * 生成40位唯一ID
	 * @return string
	 */
	public static function create40ID(){
		return sha1(uniqid(true));
	}
    /**
     * 生成订单号
     * @return string
     */
    public static function generateOrderCode(){
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }

    /**
     * 生成随机密码
     * @return string
     */
    public static function generatePassword(){
        $len=6;
        $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        mt_srand((double)microtime()*1000000*getmypid());
        $password="";
        while(strlen($password)<$len)
            $password.=substr($chars,(mt_rand()%strlen($chars)),1);
        return $password;
    }

    /**
     * 重置的默认密码
     */
    const PASSWORD = "888888";

    /**
     * 分页显示数
     */
    const PAGESIZE = '10';

    /**
     * 导出指定表数据为excel
     * @param $modelId
     */
    public static function Excel($modelId){

        $fromModel = $modelId::find()->all();
        $attributeLabels = $fromModel[0]->attributeLabels();
        $title = [];
        foreach($attributeLabels as $key => $value){
            $title[] = $value;
        }
        $models = [];
        foreach($fromModel as $key => $value){
            foreach($attributeLabels as $index => $data){
                $models[$key][$data] = $value->$index;
            }
        }
        $Phpexcel = new Phpexcel($fromModel);
        $Phpexcel->Exportexcel($title,$models);
    }

    /**
     * 检查用户是否有显示某资源的权限
     * @param $tableName
     * @param $tableOpreate
     * @return bool
     */
    public static function resource($tableName,$tableOpreate){

        $result = Yii::$app->cache->get($tableName.'_'.$tableOpreate);
        if($result){
            return true;
        }else{
            $roleId = Yii::$app->session['roleId'];
            $query = new Query();
            $resources = $query->select('a.id as id,a.tableName as tableName,a.tableOpreate as tableOpreate,a.note as note')
                ->from('resource a')
                ->where("b.roleId = :id and a.tableName = :tableName and a.tableOpreate = :tableOpreate",[':id' => $roleId,':tableName' => $tableName,':tableOpreate' => $tableOpreate])
                ->leftJoin('role_resource b','a.id = b.resourceId')
                ->one();
            if($resources){
                Yii::$app->cache->set($tableName.'_'.$tableOpreate,true,300);
                return true;
            }else{
                return false;
            }
        }
    }

	/**
	 *下载
	 * @param $files
	 * @param boolean $isPic 是否是上传图片
	 * @param boolean $isDetailPic 是否是上传细节图
	 * @param string $image_size 图片尺寸
	 * @param int $upload_size 文件最大大小，默认1G
	 * @return array $fileArg 文件上传结果
	 */
    public static function upload($files,$isPic,$isDetailPic,$image_size=null,$upload_size=1024000){

        $ALL_UPLOAD_TYPE = ['image/gif','image/jpeg','image/pjpeg', 'image/png','image/x-png',
            'video/mp4','video/rm','video/rmvb','video/wmv','video/avi','video/3gp','video/mkv','video/flv',
            'application/octet-stream','application/octet-stream',
            'application/zip','application/x-zip-compressed','application/msword',
            'application/vnd.ms-excel','application/vnd.ms-powerpoint','application/pdf',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];//配置允许上传文件的类型
        $ALL_UPLOAD_SIZE = $upload_size; //配置默认允许上传文件的大小
        $SAVEURL = "upload/";//文件保存路径
        $ALL_PIC_TYPE = ['gif','jpeg','png','jpg'];//允许上传的图片后缀
        $ALL_DOC_TYPE = ['doc','pdf','txt','ppt','xls','docx','xlsx','pptx'];//允许上传的文件后缀
        $ALL_VIDEO_TYPE = ['mp4','rm','rmvb','wmv','avi','3gp','mkv','flv '];//允许上传的视频后缀
	    $arr = [
		    'index_banner'=>['width'=>1920,'heigth'=>600],
		    'index_ecinfo'=>['width'=>355,'heigth'=>220],
		    'index_ectrain'=>['width'=>540,'heigth'=>300],
		    'index_company'=>['width'=>290,'heigth'=>250],
		    'ecinfo_info'=>['width'=>750,'heigth'=>510],
		    'ectrain_notice'=>['width'=>540,'heigth'=>300],
		    'ectrain_video'=>['width'=>340,'heigth'=>180],
		    'company_company'=>['width'=>380,'heigth'=>242],
		    'company_product'=>['width'=>290,'heigth'=>190],
		    'company_news'=>['width'=>250,'heigth'=>170],
		    'third_company'=>['width'=>300,'heigth'=>190],
		    'other_banner'=>['width'=>1920,'heigth'=>400],
            'zhandian'=>['width'=>265,'heigth'=>137]
	    ];
	    if(!empty($image_size)){
		    $new_image = $arr[$image_size];//获取指定宽高
	    }
        if($image_size == 'other_banner'||$image_size == 'index_banner'){
            $cate = 0;
        }else{
            $cate = 1;
        }
        //$new_thum_image = ['width'=>150,'heigth'=>150];//缩略图尺寸

        $fileArg = [];
        if (in_array($files["file"]["type"],$ALL_UPLOAD_TYPE) && ($files["file"]["size"] < $ALL_UPLOAD_SIZE)){
            $fileName = explode('.',$files["file"]["name"]);
            if(in_array($fileName[1],$ALL_PIC_TYPE) && $isPic){//图片处理方式
                $fileNameRandom =  date("YmdHis") . mt_rand(10,99) . '.' . $fileName[1];//生成随机文件名
                if($isDetailPic){
	                if(isset($new_thum_image)){
		                Common::resizes($files["file"]["tmp_name"],$new_thum_image['width'],$new_thum_image['heigth']);//切割
	                }
                    $fileArg['fileSaveUrl'] = $SAVEURL . 'pic/thumb_' . $fileNameRandom;
                }else{
	                if(isset($new_image)){
		                Common::resizes($files["file"]["tmp_name"],$new_image['width'],$new_image['heigth']);//切割
	                }
                    if($cate == 0){
                        $fileArg['fileSaveUrl'] = $SAVEURL . 'bigpic/' . $fileNameRandom;
                    }else{
                        $fileArg['fileSaveUrl'] = $SAVEURL . 'pic/' . $fileNameRandom;
                    }
                }
                move_uploaded_file($files["file"]["tmp_name"],$fileArg['fileSaveUrl']);
                if($cate == 0){
                    $fileArg['fileName'] = 'bigpic';
                }else{
                    $fileArg['fileName'] = 'pic';
                }
                $fileArg['tag'] = "success";
            }elseif(in_array($fileName[1],$ALL_DOC_TYPE)){//判断文件名后缀是否正确
                $fileArg['fileName'] = $fileName[0];
                $fileNameRandom =  date("YmdHis") . mt_rand(10,99) . '.' . $fileName[1];
                $fileArg['fileSaveUrl'] = $SAVEURL.'doc/' . $fileNameRandom;
                move_uploaded_file($files["file"]["tmp_name"],$fileArg['fileSaveUrl']);
                $fileArg['tag'] = "success";
            }elseif(in_array($fileName[1],$ALL_VIDEO_TYPE)){//判断文件名后缀是否正确
                $fileArg['fileName'] = $fileName[0];
                $fileNameRandom =  date("YmdHis") . mt_rand(10,99) . '.' . $fileName[1];
                $fileArg['fileSaveUrl'] = $SAVEURL.'video/' . $fileNameRandom;
                move_uploaded_file($files["file"]["tmp_name"],$fileArg['fileSaveUrl']);
                $fileArg['tag'] = "success";
            }else{
                $fileArg['fileName'] = "error";
                $fileArg['fileSaveUrl'] = "error";
                $fileArg['tag'] = "error";

            }
        }else{
            $fileArg['fileName'] = "error";
            $fileArg['fileSaveUrl'] = "error";
            $fileArg['tag'] = "error";
        }
        return $fileArg;

    }


    /**
     * 创建图片，返回资源类型
     * @param string $src 图片路径
     * @return resource $im 返回资源类型
     * **/
    public static function create($src)
    {
        $info=getimagesize($src);
        switch ($info[2])
        {
            case 1:
                $im=imagecreatefromgif($src);
                break;
            case 2:
                $im=imagecreatefromjpeg($src);
                break;
            case 3:
                $im=imagecreatefrompng($src);
                break;
        }
	    if (!empty($im)) {
		    return $im;
	    }
    }

    public static function resizes($src,$w,$h) {
        $temp=pathinfo($src);
        $name=$temp["basename"];//文件名
        $dir=$temp["dirname"];//文件所在的文件夹
        //$extension=$temp["extension"];//文件扩展名
        $savepath="{$dir}/{$name}";//缩略图保存路径,新的文件名为*.thumb.jpg

        //获取图片的基本信息
        $info=getimagesize($src);
        $type=exif_imagetype($src);
        switch($type) {
            case IMAGETYPE_JPEG :
                $src_img=imagecreatefromjpeg($src);
                break;
            case IMAGETYPE_PNG :
                $src_img=imagecreatefrompng($src);
                break;
            case IMAGETYPE_GIF :
                $src_img=imagecreatefromgif($src);
                break;
            default:
                exit();
        }
        $width=imagesx($src_img);;//获取图片宽度
        $height=imagesy($src_img);;//获取图片高度
        $per1=1.0 * $w/$width;;//计算原图长宽比
        $per2=1.0 * $h / $height;//计算缩略图长宽比

        if( ($per1 < 1 && $per2 < 1) || ($per1 > 1 && $per2 > 1)) {
            if ($per1 < $per2) {
                $ratio = $per2; // 情况一，宽度的比例比高度方向的小，按照高度的比例标准来裁剪或放大
            } else {
                $ratio = $per1;
            }
            $inter_w=(int)($w / $ratio);
            $inter_h=(int) ($h / $ratio);
            $inter_img=imagecreatetruecolor($inter_w , $inter_h);
            //var_dump($inter_img);
            imagecopy($inter_img, $src_img, 0,0,0,0,$inter_w,$inter_h);

            $new_img=imagecreatetruecolor($w,$h);
            //var_dump($new_img);exit();
            imagecopyresampled($new_img,$inter_img,0,0,0,0,$w,$h,$inter_w,$inter_h);
            if($w == '1920'){
                imagejpeg($new_img,$savepath, 80);
            }else{
                imagejpeg($new_img,$savepath, 100);
            }
            return $savepath;
        }else{
            $ratio=$per2>$per1? $per2 : $per1; //取比例大的那个值
            // 定义一个中间的大图像，该图像的高或宽和目标图像相等，然后对原图放大
            $inter_w=(int)($width * $ratio);
            $inter_h=(int) ($height * $ratio);
            $inter_img=imagecreatetruecolor($inter_w , $inter_h);
            //将原图缩放比例后裁剪
            imagecopyresampled($inter_img,$src_img,0,0,0,0,$inter_w,$inter_h,$width,$height);
            // 定义一个新的图像
            $new_img=imagecreatetruecolor($w,$h);
            imagecopy($new_img, $inter_img, 0,0,0,0,$w,$h);
            if($w == '1920'){
                imagejpeg($new_img,$savepath, 80);
            }else{
                imagejpeg($new_img,$savepath, 100);
            }
        }
}


    /**
     * 缩略图主函数
     * @param string $src 图片路径
     * @param int $w 缩略图宽度
     * @param int $h 缩略图高度
     * @return mixed 返回缩略图路径
     * **/

    public static function resize($src,$w,$h)
    {
        $temp=pathinfo($src);
        $name=$temp["basename"];//文件名
        $dir=$temp["dirname"];//文件所在的文件夹
        //$extension=$temp["extension"];//文件扩展名
        $savepath="{$dir}/{$name}";//缩略图保存路径,新的文件名为*.thumb.jpg

        //获取图片的基本信息
        $info=getimagesize($src);
        $width=$info[0];//获取图片宽度
        $height=$info[1];//获取图片高度
        $per1=round($width/$height,2);//计算原图长宽比
        $per2=round($w/$h,2);//计算缩略图长宽比

        //计算缩放比例
        if($per1>$per2||$per1==$per2)
        {
            //原图长宽比大于或者等于缩略图长宽比，则按照宽度优先
            $per=$w/$width;
        }else{
	        //原图长宽比小于缩略图长宽比，则按照高度优先
	        $per=$h/$height;
        }

        $temp_w=intval($width*$per);//计算原图缩放后的宽度
        $temp_h=intval($height*$per);//计算原图缩放后的高度
        $temp_img=imagecreatetruecolor($temp_w,$temp_h);//创建画布
        $im=Common::create($src);
        imagecopyresampled($temp_img,$im,0,0,0,0,$temp_w,$temp_h,$width,$height);
        if($per1>$per2)
        {
            imagejpeg($temp_img,$savepath, 100);
            imagedestroy($im);
            return Common::addBg($savepath,$w,$h,"w");
            //宽度优先，在缩放之后高度不足的情况下补上背景
        }
        if($per1==$per2)
        {
            imagejpeg($temp_img,$savepath, 100);
            imagedestroy($im);
            return $savepath;
            //等比缩放
        }
        if($per1<$per2)
        {
            imagejpeg($temp_img,$savepath, 100);
            imagedestroy($im);
            return Common::addBg($savepath,$w,$h,"h");
            //高度优先，在缩放之后宽度不足的情况下补上背景
        }
    }

	/**
	 * 添加背景
	 * @param string $src 图片路径
	 * @param int $w 背景图像宽度
	 * @param int $h 背景图像高度
	 * @param string $fisrt
	 * @return 返回加上背景的图片 *
	 * @internal param String $first 决定图像最终位置的，w 宽度优先 h 高度优先 wh:等比
	 */
    public static function addBg($src,$w,$h,$fisrt="w")
    {
        $bg=imagecreatetruecolor($w,$h);
        $white = imagecolorallocate($bg,255,255,255);
        imagefill($bg,0,0,$white);//填充背景

        //获取目标图片信息
        $info=getimagesize($src);
        $width=$info[0];//目标图片宽度
        $height=$info[1];//目标图片高度
        $img=Common::create($src);
        if($fisrt=="wh"){
            //等比缩放
            return $src;
        }else{
            if($fisrt=="w"){
                $x=0;
                $y=($h-$height)/2;//垂直居中
            }elseif($fisrt=="h"){
                $x=($w-$width)/2;//水平居中
                $y=0;
            }else{
	            $x=0;
	            $y=0;
            }
            imagecopymerge($bg,$img,$x,$y,0,0,$width,$height,100);
            imagejpeg($bg,$src,100);
            imagedestroy($bg);
            imagedestroy($img);
            return $src;
        }

    }



	/** @noinspection PhpTooManyParametersInspection
	 * 生成缩略图
	 * @param $src_img string 源图绝对完整地址{带文件名及后缀名}
	 * @param $dst_img string 目标图绝对完整地址{带文件名及后缀名}
	 * @param int $width 缩略图宽{0:此时目标高度不能为0，目标宽度为源图宽*(目标高度/源图高)}
	 * @param int $height 缩略图高{0:此时目标宽度不能为0，目标高度为源图高*(目标宽度/源图宽)}
	 * @param int $cut 是否裁切{宽,高必须非0}
	 * @param int $proportion 缩放{0:不缩放, 0<this<1:缩放到相应比例(此时宽高限制和裁切均失效)}
	 * @return bool
	 */
	public static function img2thumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0)
    {
        if(!is_file($src_img))
        {
            return false;
        }
	    $ot = pathinfo($dst_img, PATHINFO_EXTENSION);
        //$ot = get_extension($dst_img);
        $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
        $srcinfo = getimagesize($src_img);
        $src_w = $srcinfo[0];
        $src_h = $srcinfo[1];
        $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
        $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);

        $dst_h = $height;
        $dst_w = $width;
        $x = $y = 0;

        /**
         * 缩略图不超过源图尺寸（前提是宽或高只有一个）
         */
        if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
        {
            $proportion = 1;
        }
        if($width> $src_w)
        {
            $dst_w = $width = $src_w;
        }
        if($height> $src_h)
        {
            $dst_h = $height = $src_h;
        }

        if(!$width && !$height && !$proportion)
        {
            return false;
        }
        if(!$proportion)
        {
            if($cut == 0)
            {
                if($dst_w && $dst_h)
                {
                    if($dst_w/$src_w> $dst_h/$src_h)
                    {
                        $dst_w = $src_w * ($dst_h / $src_h);
                        $x = 0 - ($dst_w - $width) / 2;
                    }
                    else
                    {
                        $dst_h = $src_h * ($dst_w / $src_w);
                        $y = 0 - ($dst_h - $height) / 2;
                    }
                }
                else if($dst_w xor $dst_h)
                {
                    if($dst_w && !$dst_h)  //有宽无高
                    {
                        $propor = $dst_w / $src_w;
                        $height = $dst_h  = $src_h * $propor;
                    }
                    else if(!$dst_w && $dst_h)  //有高无宽
                    {
                        $propor = $dst_h / $src_h;
                        $width  = $dst_w = $src_w * $propor;
                    }
                }
            }
            else
            {
                if(!$dst_h)  //裁剪时无高
                {
                    $height = $dst_h = $dst_w;
                }
                if(!$dst_w)  //裁剪时无宽
                {
                    $width = $dst_w = $dst_h;
                }
                $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
                $dst_w = (int)round($src_w * $propor);
                $dst_h = (int)round($src_h * $propor);
                $x = ($width - $dst_w) / 2;
                $y = ($height - $dst_h) / 2;
            }
        }
        else
        {
            $proportion = min($proportion, 1);
            $height = $dst_h = $src_h * $proportion;
            $width  = $dst_w = $src_w * $proportion;
        }

        $src = $createfun($src_img);
        $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
        $white = imagecolorallocate($dst, 255, 255, 255);
        imagefill($dst, 0, 0, $white);

        if(function_exists('imagecopyresampled'))
        {
            imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        else
        {
            imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        $otfunc($dst, $dst_img);
        imagedestroy($dst);
        imagedestroy($src);
        return true;
    }
}