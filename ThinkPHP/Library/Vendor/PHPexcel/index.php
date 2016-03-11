<?php
include_once '/index.php';
header("Content-type: text/html; charset=utf-8");
/**
 * PHPEXCEL生成excel文件
 * @author:firmy
 * @desc 支持任意行列数据生成excel文件，暂未添加单元格样式和对齐
 */
if(($_SESSION['level']<2)){
    echo "<h3>下载权限需要等级达到</h3><h1>不屈白银Ⅱ</h1><h3>以上</h3>";
    exit();
}
include_once './connection.php';
require_once './Classes/PHPExcel.php';
require_once './Classes/PHPExcel/Writer/Excel2007.php';
require_once './Classes/PHPExcel/Writer/Excel5.php';
include_once './Classes/PHPExcel/IOFactory.php';
$fileName = "feng";
$headArr = array("物品名称","编号","价格");
if(!empty($_GET['page'])){
    switch ($_GET['page']) {
        case '1':
            $sql="select * from fli_stock";
            break;
        case '2':
            $sql="select * from fli_stock where stock=0";
            break;
        case '3':
                $sql="select * from fli_stock where stock=1";
                break;
        default:
            echo "3";
            exit();
            break;
    }
}
$res=mysql_query($sql);
while ($row=mysql_fetch_assoc($res)) {
    $data[]=array("{$row['goods']}","{$row['num']}","{$row['Money']}");
}
getExcel($fileName,$headArr,$data);


function getExcel($fileName,$headArr,$data){
    if(empty($data) || !is_array($data)){
        die("data must be a array");
    }
    if(empty($fileName)){
        exit;
    }
    $date = date("Y_m_d",time());
    $fileName .= "_{$date}.xls";

    //创建新的PHPExcel对象
    $objPHPExcel = new PHPExcel();
    $objProps = $objPHPExcel->getProperties();
	
    //设置表头
    $key = ord("A");
    foreach($headArr as $v){
        $colum = chr($key);
        $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
        $key += 1;
    }
    
    $column = 2;
    $objActSheet = $objPHPExcel->getActiveSheet();
    foreach($data as $key => $rows){ //行写入
        $span = ord("A");
        foreach($rows as $keyName=>$value){// 列写入
            $j = chr($span);
            $objActSheet->setCellValue($j.$column, $value);
            $span++;
        }
        $column++;
    }

    $fileName = iconv("utf-8", "gb2312", $fileName);
    //重命名表
    $objPHPExcel->getActiveSheet()->setTitle('Simple');
    //设置活动单指数到第一个表,所以Excel打开这是第一个表
    $objPHPExcel->setActiveSheetIndex(0);
    //将输出重定向到一个客户端web浏览器(Excel2007)
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header("Content-Disposition: attachment; filename=\"$fileName\"");
          header('Cache-Control: max-age=0');
          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        //   if(!empty($_GET['excel'])){
        //     $objWriter->save('php://output'); //文件通过浏览器下载
        // }else{
        //   $objWriter->save($fileName); //脚本方式运行，保存在当前目录
        // }
          $objWriter->save('php://output');
  exit;

}
