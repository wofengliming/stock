<?php
namespace Home\Controller;
use Think\Controller;
header("Content-type: text/html; charset=utf-8"); 
	 class StockController extends CommonController{
	 		public function index(){
	 			$me=D('Stock');
	 			// import('ORG.Util.Page');// 导入分页类
	 			$count = $me->count();// 查询满足要求的总记录数
	 			$Page = new  \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
	 			// $Page->setConfig('header','啊件库存');
	 			$Page -> setConfig('header','共%TOTAL_ROW%条');
				$Page -> setConfig('first','首页');
				$Page -> setConfig('last','共%TOTAL_PAGE%页');
				$Page -> setConfig('prev','上一页');
				$Page -> setConfig('next','下一页');
// $Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
				$Page -> setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
				$show=$Page->show();

	 			// $sql="select * from `fli_stock` order by time desc";//desc升序
	 			// $arr=$me->query($sql);
	 			// echo $table->getlastsql(); //输出最后查询的一句SQL 一般校验SQL错误都是从这里来的
	 			// dump($arr);
	 			// exit;
	 			// 模糊查询
	 			if(isset($_POST['num']) && !empty($_POST['num'])) {
	 				$map['num']=array('LIKE',"%".trim($_POST['num'])."%");
	 				$map['goods']=array('LIKE',"%".trim($_POST['num'])."%");
	 				$map['_logic'] = 'OR';
	 				// $arr=$me->relation('user')->where($map)->select();
	 				$arr=$me->where($map)->order('time desc')->select();
	 				$count1=count($arr);
	 				$Page = new \Think\Page($count1,15);// 实例化分页类 传入总记录数和每页显示的记录数
	 			$Page -> setConfig('header','共%TOTAL_ROW%条');
				$Page -> setConfig('first','首页');
				$Page -> setConfig('last','共%TOTAL_PAGE%页');
				$Page -> setConfig('prev','上一页');
				$Page -> setConfig('next','下一页');
// $Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
				$Page -> setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');	
				$show=$Page->show();
	 			}else{

					 			if(!isset($_GET['stock'])){
					 					// $arr=$me->order('time desc')->relation('user')->limit($Page->firstRow.','.$Page->listRows)->select();
					 					$arr=$me->order('time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
					 					// var_dump($arr);
					 					// exit();
					 			}elseif ($_GET['stock'] == 1) {
					 					// $arr=$me->order('time desc')->relation('user')->where("stock=1")->limit($page->firstRow.','.$page->listRows)->select();
					 					$arr=$me->order('time desc')->where("stock=1")->limit($Page->firstRow.','.$Page->listRows)->select();
					 					// 获取入库的共多少件
					 					$count1=$me->where('stock=1')->count();
					 					$Page = new \Think\Page($count1,15);// 实例化分页类 传入总记录数和每页显示的记录数
							 			$Page -> setConfig('header','共%TOTAL_ROW%条');
										$Page -> setConfig('first','首页');
										$Page -> setConfig('last','共%TOTAL_PAGE%页');
										$Page -> setConfig('prev','上一页');
										$Page -> setConfig('next','下一页');
										// $Page -> setConfig('link','indexpagenumb');//pagenumb 会替换成页码
										$Page -> setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');	
					 					// if(isset($_SESSION['bookname'])){
					 					// $this->assign('count',"<span style='font-size:18px'>入库".$count1."件···出库".($count-$count1)."件</span>");
					 					// }
					 					$show=$Page->show();
					 			}else{
					 					$arr=$me->order('time desc')->where("stock=0")->limit($Page->firstRow.','.$Page->listRows)->select();
					 					// 获取出库的共多少件
					 					$count1=$me->where('stock=0')->count();
					 					$Page = new \Think\Page($count1,15);// 实例化分页类 传入总记录数和每页显示的记录数
							 			$Page -> setConfig('header','共%TOTAL_ROW%条');
										$Page -> setConfig('first','首页');
										$Page -> setConfig('last','共%TOTAL_PAGE%页');
										$Page -> setConfig('prev','上一页');
										$Page -> setConfig('next','下一页');
										$Page -> setConfig('theme','%HEADER% %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');	
										$show=$Page->show();
					 			}
	 		}
	 			
	 			$this->assign('stock',$arr);
	 			//分配给页面  分页栏
	 			if(!isset($_SESSION['bookname'])){
		 				$this->assign("show","<h1>登陆后可翻页</h1>");
		 			}else{
		 				$this->assign('show',$show);
		 			}
	 			

	 		$this->display();	 			
	 		}
	 		// 添加存储库信息
	 		public function domess(){
	 			$me=D('Stock');
	 			// $me->title=$_POST['title'];
	 			// $me->content=$_POST['content'];
		 			if(!isset($_SESSION['bookname'])){
		 				$this->error("登陆后执行");
		 			}
		 			if(!$me->create()){
		 				$this->error($me->geterror());
		 			}		 			
		 			$aaa=$me->add();
		 			if ($aaa) {
		 				$this->success('添加成功');
		 			}else{
		 				$this->error('添加失败');
		 			}
			}
			// 添加库存页面
			public function stock(){
				$this->display();
			}
			// 修改入库为出库
			public function modstock1(){
					if(empty($_SESSION['bookname'])){
						$this->error("登陆后执行");
					}else{
						$id=$_GET['id'];
						$name=$_SESSION['bookname'];
						$m=M('Stock');
						$data['stock']=0;
						$data['time']=time();
						$data['filename']=$name;
						$aaa=$m->where("id='$id'")->save($data);
							if($aaa){
							$this->success("修改成功");
						}else{
							$this->error("修改失败");
						}
					}
			}
			// 修改出库为入库
			public function modstock2(){
				if(empty($_SESSION['bookname'])){
					echo "<a href='../User/login'>请登录</a>";
				}else{
					$id=$_GET['id'];
					$name=$_SESSION['bookname'];
						$m=M('Stock');
						$data['stock']=1;
						$data['time']=time();
						$data['filename']=$name;
						$aaa=$m->where("id='$id'")->save($data);
						if($aaa){
						$this->success("修改成功");
					}else{
						$this->error("修改失败");
					}
				}
			}
			
			// 删除程序
			public function delstock(){
					if($_SESSION['level']<3){
						$this->error("删除程序需要等级达到璀璨黄金以上");
					}else{
						$id=$_GET['id'];
						$me=M('Stock');
						$aa=$me->where("id='$id'")->delete();
						if($aa){
							$this->success("删除成功","index");
						}else{
							$this->error("删除失败");
						}
					}
			}
			// 修改页面
			public function updata(){
				$this->assign("id",$_GET['id']);
				$this->display();
			}
			// 修改程序
			public function upstock(){
				if(empty($_SESSION['bookname'])){
					echo "<a href='../User/login'>请登录</a>";
				}else{
					$me=D('Stock');
					if(!$me->create()){
		 				$this->error($me->geterror());
		 			}		 			
		 				$id=$_POST['id'];
						$name=$_SESSION['bookname'];
						$m=M('Stock');
						$data['goods']=$_POST['goods'];
						$data['num']=$_POST['num'];
						$data['Money']=$_POST['Money'];
						$data['time']=time();
						$data['filename']=$name;
						$aaa=$m->where("id='$id'")->save($data);
						if($aaa){
						$this->success("修改成功");
					}else{
						$this->error("修改失败");
					}
				}

			}
			// 下载数据表
			public function phpexcel(){
					$this->display();
			}
			// 批量删除操作
		public function batchdel(){
			if($_SESSION['level']<3){
						$this->error("删除程序需要等级达到璀璨黄金以上,请登录拥有全选的账号");
					}
			// $M=M('Stock');
				if(isset($_POST['action']) && $_POST['action'] == 'del'){
				    //根据id删除数据库数据
				    $Strdel=$_POST['gid'];
					if (!empty($Strdel)) {
						$M=M('Stock');
					}else{
						$this->error("选择要删除的数据");
					}
					
				}
				$token = strtok($Strdel, ",");

					while ($token !== false)
					{
					$date=$M->where("id='$token'")->delete();
					$token = strtok(",");
					}
					$this->success("删除成功");
		}
	}
?>