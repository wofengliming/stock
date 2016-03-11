<?php
namespace Home\Model;
use Think\Model\RelationModel;
	class StockModel extends RelationModel{
		//自动完成
		protected $_auto=array(
				array('time','time',3,'function'),//留言时间
				array('UID','getID',3,'callback'),//留言ID
				array('filename','getname',3,'callback'),//留言人
			);
				protected function getID(){
					return $_SESSION['id'];
				}
				protected function getname(){
					return $_SESSION['bookname'];
				}
				//自动验证
			protected $_validate = array(
					array('num','require','兄弟,编号没填！'),
					array('num','','编号已存在',0,'unique',3)
					
				);
				//关联
		protected $_link =array(
					'user'=> array(  
		     			'mapping_type'=>self::BELONGS_TO,
		        		'class_name'=>'user',
		        		'foreign_key'=>'uid',//本表ID
		          		'mapping_name'=>'user',//名字
		          		'mapping_fields'=>'name,psword',
		          		'as_fields'=>'name:psword',//给被关联表字段名改名
					),	
			);
	}	

?>