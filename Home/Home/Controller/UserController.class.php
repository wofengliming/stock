<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
    public function setuser(){
   	$this->display();
    }
    public function addadmin(){
        // $code=$_POST['code'];
        // function check_verify($code, $id = ''){
        //     $verify = new \Think\Verify();
        //     return $verify->check($code, $id);
        // }
        // if (check_verify($code) === false) {
        //     $this->error('验证码错误');
        // }
    	    $user=D("User");
        	if(!$user->create()){
        		$this->error($user->geterror());
                // exit($user->getError());
        	}
        	$arr=$user->add();
        	if($arr){
        		// $this->success("注册成功",U('Index/index'));
                $this->success("注册成功","/#menu/code");
        	}else{
        		$this->error('注册失败');
        	}
    }

    //登陆
    public function login(){
        $this->display();
    }
    //登录验证
    public function login_check(){
        $m=D('User');
        $name=$_POST['name'];
        $psword=md5($_POST['psword']);
        //3.1.3验证码判断
        $code=$_POST['code'];
            // if($_SESSION['code']!==md5($code)){
            //     $this->error('验证码错误');
            // }
        // 3.2.3  验证码
        function check_verify($code, $id = ''){
            $verify = new \Think\Verify();
            return $verify->check($code, $id);
        }
        if (check_verify($code) === false) {
            $this->error('验证码错误');
        }
           $user=$m->where("name='$name'")->find();
            if($psword==$user['psword']&& $psword  !=''){
                // 将用户名ID保存到SESSION
                    $_SESSION['id']=$user['id'];
                    $_SESSION['bookname']=$user['name'];
                    $_SESSION['level']=$user['level'];
                    // SESSION('bookname',"{$user['name']}",1200);
                    $this->success('登录成功',"/#menu/code");          
                    }else{
            if(empty($user)){
                    $this->error("用户名不存在");
                    }
                $this->error('密码错误');
                        }
    }
    // 会员管理
    public function userlist(){
                // 3.1.3  分页类
                // $me=D('user');
                // import('ORG.Util.Page');// 导入分页类
                // $count = $me->count();// 查询满足要求的总记录数
                // $page = new Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数
                // $page->setConfig('header','位');
                // $show = $page->show();// 分页显示输出
                // $arr=$me->order('level desc')->limit($page->firstRow.','.$page->listRows)->select();
                // $this->assign('user',$arr);
                // $this->assign('show',"共".$show);
        $me=D('User');
                // import('ORG.Util.Page');// 导入分页类
                $count = $me->count();// 查询满足要求的总记录数
                $Page = new \Think\Page($count,4);// 实例化分页类 传入总记录数和每页显示的记录数
                // $Page->setConfig('header','位');
                $Page -> setConfig('header','共%TOTAL_ROW%位');
                $Page -> setConfig('first','首页');
                $Page -> setConfig('last','共%TOTAL_PAGE%页');
                $Page -> setConfig('prev','上一页');
                $Page -> setConfig('next','下一页');
                $Page -> setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
                $show = $Page->show();// 分页显示输出
                $arr=$me->order('level desc')->limit($Page->firstRow.','.$Page->listRows)->select();
                $this->assign('user',$arr);
                $this->assign('show',"共".$show);
                $this->display();
    }
    // 修改级别页面
    public function uplevel(){
        // $me=M('user');
        $name=$_GET['name'];
        // $data['level']=
        // $me->where("id='$id'")->save();
        $this->assign("name",$name);
        $this->display();
    }
    // 修改级别程序
    public function uplevelup(){
        if($_SESSION['level']<6){
            $this->error("用户权限不足以操作");
        }
        $name=$_POST['name'];
        $me=M('user');
        $data['level']=intval($_POST['level']);
        $aaa=$me->where("name='$name'")->save($data);
        if($aaa){
            $this->success("修改成功",U('user/userlist'));
        }
        $this->error("修改失败");
        

    }
    // 修改密码
    // 删除用户
}