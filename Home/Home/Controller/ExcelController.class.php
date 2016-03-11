<?php
namespace Home\Controller;
use Think\Controller;
header("Content-type: text/html; charset=utf-8");
    class ExcelController extends CommonController{
        public function index(){
            $this->display();
        }
        public function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $xlsTitle.date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel.PHPExcel");
       
        $objPHPExcel = new\ PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
       // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));  
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]); 
        } 
          // Miscellaneous glyphs, UTF-8   
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
          }             
        }  
        
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=\"$fileName.xls\"");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
        $objWriter->save('php://output'); 
        exit;   
    }
 /**
     *
     * 导出Excel
     */
    function expUser(){//导出Excel
        ob_clean();
        $xlsName  = "欢迎下载";
        $xlsCell  = array(
        array('goods','物品'),
        array('num','编号'),
        array('Money','价格')   
        );
        $xlsModel = M('Stock');
    
         if (empty($_GET)){
                    // 导出全部库存
            $xlsName="全部";
                $xlsData  = $xlsModel->field('goods,num,Money')->select();
            }else{
                if ($_GET['page']==1) {
            $xlsName="出库";
                    // 导出出库库存
                   $xlsData  = $xlsModel->where('stock=0')->field('goods,num,Money')->select();
                }else{
            $xlsName="入库";
                    // 导出入库库存
                     $xlsData  = $xlsModel->where('stock=1')->field('goods,num,Money')->select();
                }
            }
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
         
    }
    }