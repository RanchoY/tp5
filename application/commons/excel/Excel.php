<?php 
namespace app\commons\excel;
use think\Controller;
use think\Request;

import('PHPExcel', EXTEND_PATH.'/PHPExcel/');

class Excel extends Controller
{
    function __construct(){
        parent::__construct();
    }
    static function writer($header, $data,$name=false,$xuhao=1,$type = 0) {
        //导出
        if(!$name){$name=date("Y-m-d-H-i-s",time());}
        
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();
        //设置表头
        $key = ord("A");
        if($xuhao==1){
           array_unshift($header,'序号');
        }
        foreach($header as $v){
            $colum = chr($key);
            $objPHPExcel->getActiveSheet()->getColumnDimension($colum)->setWidth(20);
            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->getStyle($colum.'1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum.'1', $v)->getStyle($colum.'1')->getFont()->setName('宋体')->setSize(12)->setBold(true);
            $key += 1;
        }

        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();
        $objActSheet->getRowDimension(1)->setRowHeight(20);
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
          if($xuhao==1){
              array_unshift($rows,$column-1);
          }
            foreach($rows as $keyName=>$value) {// 列写入
                $j = chr($span);
                $objActSheet->getRowDimension($column)->setRowHeight(20);
                $objActSheet->getColumnDimension($j)->setWidth(25);
                $objPHPExcel->getActiveSheet()->getStyle($j.$column)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }
        $objPHPExcel->getActiveSheet()->setTitle('数据表');
        $objPHPExcel->setActiveSheetIndex(0);
        $fileName = iconv("utf-8", "gb2312", './Data/excel/'.date('Y-m-d_', time()).time().'.xls');
        $saveName =$name.'.xls';
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        if ($type == 0) {
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=\"$saveName\"");
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
        } else {
            $objWriter->save($fileName);
            return $fileName;
        }
    }

    static function reader($file) {

        if (self::_getExt($file) == 'xls') {
            import("Tools.Excel.PHPExcel.Reader.Excel5");
            $PHPReader = new \PHPExcel_Reader_Excel5();
        } elseif (self::_getExt($file) == 'xlsx') {
            import("Tools.Excel.PHPExcel.Reader.Excel2007");
            $PHPReader = new \PHPExcel_Reader_Excel2007();
        } else {
            return '路径出错';
        }

        $PHPExcel     = $PHPReader->load($file);
        $currentSheet = $PHPExcel->getSheet(0);
        $allColumn    = $currentSheet->getHighestColumn();
        $allRow       = $currentSheet->getHighestRow();
        for($currentRow = 1; $currentRow <= $allRow; $currentRow++){
            for($currentColumn='A'; $currentColumn <= $allColumn; $currentColumn++){
                $address = $currentColumn.$currentRow;
                $arr[$currentRow][$currentColumn] = $currentSheet->getCell($address)->getValue();
            }
        }
        return $arr;
    }

    private static function _getExt($file) {
        return pathinfo($file, PATHINFO_EXTENSION);
    }


    public function out(){
        $file_name   = "成绩单-".date("Y-m-d H:i:s",time());
        $file_suffix = "xlsx";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file_name.$file_suffix");

        //根据业务，自己进行模板赋值。
        return $this->fetch();

    }

    public function in(){
        $content = file_get_contents('./UploadFiles/excel/ceshi.xlsx');
        dump($content);exit;

    }

}