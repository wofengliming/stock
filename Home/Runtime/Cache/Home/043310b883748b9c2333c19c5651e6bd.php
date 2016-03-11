<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title>疯OOK</title>
	<link rel="stylesheet" type="text/css" href="/Public/CSS/FORM.css" />
		<script type="text/javascript" src="/Public/JS/jquery.js"></script>
	<script type="text/javascript" src="/Public/JS/code.js"></script>

</head>
	<body>
		<div class="img1">
			<img src="/Public/IMG/img1.png"/>
		</div>
	<div class="FORMDIV" align="center">
		<form action="/index.php/Home/User/login_check" method="post"name="myform"/>
			<table>
				<tr>
					<td>用户名:</td><td><input  type='text' name='name'class="text1"placeholder='用户名' /></td>
				</tr>
				<tr>
					<td>密&nbsp&nbsp码:</td><td><input type='password' class='text1' name='psword'placeholder='密码'/></td>
				</tr>
				<tr>
					<td>验证码:</td>
					<td> <input type='text'id='code' name='code' class="text1"  placeholder='验证码'/></td>
				</tr>
				<tr><td></td><td><img src="/index.php/Home/Public/code" onclick='this.src=this.src+"?"+Math.random()'/></td></tr>
				<tr>
					<td colspan="2">
						<a href="#"><img src="/Public/IMG/login.gif" onclick="sub()"></a>
						<a href="/index.php/Home/User/setuser"><img src="/Public/IMG/add.gif"></a>
					</td>					
				</tr>
			</table>         	
	</form>	
	</div>	
	</body>
</html>