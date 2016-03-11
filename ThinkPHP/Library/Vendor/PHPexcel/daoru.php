<?php
session_start();
header("Content-type: text/html; charset=utf-8"); 
echo $_SESSION['level'];
if(($_SESSION['level']<2)){
    echo "<h3>下载权限需要等级达到</h3><h1>不屈白银Ⅱ</h1><h3>以上</h3>";
    exit();
}
//include "PHPExcel/Classes/phpExcel/Writer/IWriter.php";
//include "PHPExcel/Classes/phpExcel/Writer/Excel5.php";
//require_once 'PHPExcel/Classes/phpExcel/Writer/Excel2007.php';
require_once './Classes/PHPExcel.php';
include_once('connection.php');
//include 'PHPExcel/Classes/phpExcel/IOFactory.php';
 
//设定缓存模式为经gzip压缩后存入cache（PHPExcel导入导出及大量数据导入缓存方式的修改 ） 
$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip; 
$cacheSettings = array(); 
PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings); 
 
 $objPHPExcel = new PHPExcel();
 // $con = mysql_connect("localhost","root","");
 // mysql_select_db('stock');
 // mysql_set_charset("utf8");
//读入上传文件
if($_POST){
    $objPHPExcel = PHPExcel_IOFactory::load($_FILES["inputExcel"]["tmp_name"]);
    //内容转换为数组 
    $indata = $objPHPExcel->getSheet(0)->toArray();
    // print_r($indata );
    //excel  sheet个数
    //echo $objPHPExcel->getSheetCount();
   
    //把数据新增到mysql数据库中
    foreach($indata as $item){
        $sql = "insert into fli_daoru(name,email,institute)values('$item[0]','$item[1]','$item[2]')";
        mysql_query($sql);
        // echo $item[2]."<br/>";
        // echo $item[1]."<br/>";
    }
    // // header("location:zhongguo.php","跳转成功");
    echo"成功"."<a href='/stock'>返回首页</a>";
}  
//查看是否导入成功
 // $sql1="select * from fli_daoru";
 // $query = mysql_query($sql1);
 // while($data = mysql_fetch_array($query)){
 //     echo $data['value'];
 //     }
?>