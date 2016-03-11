<?php
namespace Home\Controller;
use Think\Controller;
	class PublicController extends Controller{
		function code(){
			ob_clean();
    		$config =    array(
   								 
   								 // 'useNoise'    =>    false, // 关闭验证码杂点
   								 'imageW'	   =>   154,
   								 'imageH'	   =>   40,
   								 'fontSize'    =>    20,    // 验证码字体大小
    							 'length'      =>    4,     // 验证码位数
   								 // 'useZh'	   => 'true',
			);
    		$Verify = new \Think\Verify($config);
    		$Verify->entry();
		}
		//注销
		function dologout(){
			session_unset('');
			// $this->success('注销成功',U('Index/index'));
			$this->success('注销成功',"/#menu/code");
		}
	}
?>
