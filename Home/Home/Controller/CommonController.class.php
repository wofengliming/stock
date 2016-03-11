<?php
namespace Home\Controller;
use Think\Controller;
	class commonController extends Controller{
			public function _initialize(){
						$bookname=$_SESSION['bookname'];
						$user=M('User');
						$level=$user->where("name='$bookname'")->find();
						// 判断会员等级					
						if (!isset($level)) {									
						}else{
								switch ($level['level']) {
									case '1':
										 $dengji="<p class='level1'>英勇黄铜Ⅰ</p>";
										break;
									case '2':
										$dengji="<p class='level2'>不屈白银Ⅱ</p>";
									    break;
									case '3':
										$dengji="<p class='level3'>荣耀黄金Ⅲ</p>";
										break;
									case '4':
										$dengji="<p class='level4'>华贵铂金Ⅳ</p>";
									    break;
									case '5':
										$dengji="<p class='level5'>璀璨钻石Ⅴ</p>";
										break;
									case '6':
										$dengji="<p class='level6'>最强王者Ⅵ</p>";
										break;
									default:
										$dengji="查无此人";
										break;
								}
						}
						
				$this->assign('bookname',$bookname);
		     	if (!isset($_SESSION['bookname']) || $_SESSION['bookname']=='') {
		    			// $this->assign("arr2","欢迎访问<a href=".U('Index/index').">库存首页</a>,　请<a href=".U('user/login').">登录</a>或<a href=".U('user/setuser').">注册</a>");
		       			$this->assign("arr2","<div class='dl-log'>欢迎您访问，<span class='dl-log-user'>库存首页<a href=".U('user/login')." title='登录系统' class='dl-log-quit'>[登录]</a>　或<a href=".U('user/setuser')." title='注册账号' class='dl-log-quit'>[注册]</a>");
		       }else{
		    		    // $this->assign("arr1","尊敬的<a href='#'>".$bookname."</a>您的等级为".$dengji."欢迎访问.　　　　　　　　<a href=".U('Daoru/daoru').">上传表库</a>　　<a href=".U('Stock/phpexcel').">下载表库</a>　　　<a href=".U('index/index').">库存首页</a>　　<a href=".U('public/dologout').">注销</a>　　　　　<a href=".U('User/userlist').">会员管理</a>");
		    		   $this->assign("arr1","<div class='dl-log'>欢迎您，<span class='dl-log-user'>".$bookname."</span> <a href=".U('public/dologout')." title='退出系统' class='dl-log-quit'>[退出]</a>");
		    		    	} 				
			}
	}
?>