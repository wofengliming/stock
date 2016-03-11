<?php
namespace Home\Model;
use Think\Model;
	class UserModel extends Model{
		protected $_auto =array(
				array('psword','md5',3,'function'),
			);
		
		// 验证规则
		protected $_validate = array(
			array('code','require','验证码必须填写'),
			array('code','checkcode','验证码错误',0,'callback',3),
			array('name','require','兄弟,用户名都不写？'),
			array('name','/^\w{5,15}$/','用户名要在5-15之间且不能为中文',0,'regex',3),
			array('name','','用户已经存在',0,'unique',3),
			array('psword','psword2','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
			array('psword','/^\w{5,12}$/','密码要在5-12之间',0,'regex',3),

		);
		// 验证码验证3.1.3
			// protected function checkcode($code){
			// 		if (md5($code)!=$_SESSION['code']) {
			// 				return false;
			// 		}else{
			// 				return true;
			// 		}
			// }
		// 验证码3.2.3
		protected	function check_verify($code, $id = ''){
            $verify = new \Think\Verify();
            return $verify->check($code, $id);
       		 }
		protected function checkcode($code){
			if ($this->check_verify($code) === false) {
          		  return false;
      		  }else{
      		  	return true;
      		  }
		}
		
	}
?>