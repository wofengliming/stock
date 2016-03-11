<?php if (!defined('THINK_PATH')) exit();?><div>
	<form method="POST" action="/index.php/Home/Stock/domess">
			<table>
				<tr>
					<td>物品名称：</td><td><input type="text" name="goods"/></td>
				</tr>
				<tr>
					<td>物品编号：</td><td><input type="text" name="num"/></td>
				</tr>
				<tr>
					<td>物品价格：</td><td><input type="text" name="Money"/></td>
				</tr>
				<tr><td clospan="2"><input value="提交" type="submit"/></td></tr>
			</table>
	</form>
</div>