<?php
/**
 * 操作excel类
 */
namespace app\common;
use yii\phpexcel\Yiiexcel;
use yii\phpexcel\YiiexcelIOFactory;
use yii\phpexcel\YiiexcelPHPExcelWriterExcel5;

/**
 * Class Phpexcel
 * @package app\common
 */
class Phpexcel
{
    private $columnExcel;
    private $formModel;

	/**
	 * 构造函数
	 * @param $formModel
	 */
    public function __construct($formModel)
    {
        //excl列转换数组
        $columnExcel = [];
        for($i='A';$i<='Z';$i++)
        {
	        $columnExcel[] = $i;
            if(count($columnExcel)>=52)
            {
                break;
            }
        }
        $this->columnExcel = $columnExcel;
        $this->formModel = $formModel;
        
    }

	/**
	 * 导出excel
	 * $title 标题数组
	 * $models 数据数组
	 * $outputFileName  输出的文件名
	 * @param $title
	 * @param $models
	 * @param string $outputFileName
	 * @throws \PHPExcel_Exception
	 */
    public function Exportexcel($title,$models,$outputFileName = 'statistics.xls')
    {
        $columnExcel = $this->columnExcel;
        $phpExcel = new Yiiexcel();
        $phpExcel->setActiveSheetIndex(0);
        $flag = 1;
        $j = 0;
        foreach ($title as $a=>$b)
        {
            $phpExcel->getActiveSheet()->setCellValue($columnExcel[$j].$flag,$b);
            $j++;
        }
        $flag++;
        foreach ($models as $key=>$val)
        {
            $j = 0;
            foreach ($val as $k=>$v)
            {
                $phpExcel->getActiveSheet()->setCellValue($columnExcel[$j].$flag,$v);
                $j++;
            }
            $flag++;
        
        }
        $xlsWriter = new YiiexcelPHPExcelWriterExcel5($phpExcel);
        ob_start();
        ob_flush();
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition:inline;filename="'.$outputFileName.'"');
        header("Content-Transfer-Encoding: binary");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $xlsWriter->save( "php://output" );
        exit;
    }

    // 读取excel
	/**
	 * @param $filename
	 * @return array
	 */
	public function ReadExcel($filename){
        $phpExcel = new Yiiexcel();
        $objPHPExcel = YiiexcelIOFactory::load($filename);
        $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
        return $sheetData;
    }
}