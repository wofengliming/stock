<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
  <title></title>
	<script type="text/javascript" src="/Public/JS/jquery.js"></script>
	<script type="text/javascript" src="/Public/JS/jquery.easyui.min.js"></script>
	<style type="text/css">
		.dd-demo{
			width:200px;
			height:60px;
			border:2px solid #d3d3d3;
			position:absolute;
		}
		.proxy{
			border:1px dotted #333;
			width:200px;
			height:60px;
			text-align:center;
			background:#fafafa;
		}
		div{
			text-align: center;
			line-height: 60px;
		}
		#dd1{
			background:#E0ECFF;
			left:20px;
			top:20px;
		}
		#dd2{
			background:#8DB2E3;
			left:170px;
			top:10px;
		}
		#dd3{
			background:#FBEC88;
			left:450px;
			top:20px;
		}
	</style>
	<script>
		$(function(){
			$('#dd1').draggable();
			$('#dd2').draggable({
				proxy:'clone'
			});
			$('#dd3').draggable({
				proxy:function(source){
					var p = $('<div class="proxy">proxy</div>');
					p.appendTo('body');
					return p;
				}
			});
		});
	</script>
</head>
<body>
	<div id="dd1" class="dd-demo">欢迎访问后台首页</div>
	<div id="dd2" class="dd-demo">您的IP地址为:<?php echo ($ip); ?></div>
	<div id="dd3" class="dd-demo">若有重叠请拖走他</div>
</body>
</html>