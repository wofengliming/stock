<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	// if(!isset($_SESSION['bookname']) || $_SESSION['bookname']==' '){
    	// 	echo "<script> alert('请登录');</script>";
    	// }
    	$this->display();
    }
    public function main(){
    	$IP3=getIP2();
    	$this->assign("ip",$IP3);
    	// 当前IP所在位置
    	$this->display();

    }

}