<?php if (!defined('THINK_PATH')) exit();?>    <link rel="stylesheet" type="text/css" href="/Public/CSS/Stock/index.css"/>
    <script type="text/javascript" src="/Public/js/jquery.js"></script>
    <!-- 全选JS -->
    <script type="text/javascript">
$(function(){
    //选中全部
    $('.selectAll').click(function(){
    $('#dataList').find('tr').each(function(){
      $(this).find(':checkbox').prop('checked',true);
    });
    });

    //反选
    $('.revSelectAll').click(function(){
    $('#dataList').find('tr').each(function(){
      if($(this).find(':checkbox').prop('checked')){
        $(this).find(':checkbox').prop('checked',false);
      }else{
        $(this).find(':checkbox').prop('checked',true);
      }
    });
    });

    //全不选
    $('.delSelectAll').click(function(){
    $('#dataList').find('tr').each(function(){
      $(this).find(':checkbox').prop('checked',false);
    });
    });
  
  //删除选中数据处理
  $('#form').submit(function(){
      if (!confirm("是否确认删除所选商品, 删除后不可恢复"))  { 
          return false;
      } 
    var gid = '';
    $(':checkbox').each(function(){
      if($(this).prop('checked')){
                var id = $(this).val();
                   gid += id+','
      }
    });
    gid = gid.substring(0,gid.length-1);
    $('[name=gid]').val(gid);
    return true;
    });
})
</script>
    <!-- 全选JS -->
    <form action="/index.php/Home/stock/index" method="POST" >
        <input type="text" placeholder="搜索模糊" name="num"></input><input type="submit" value="模糊搜索"/>      
      </form>
<div class="table" >
<table id="dataList">
    <tr>
          <th>操作</th><th>物品编号</th><th>物品名称</th><th>物品价格</th><th>执行人员</th><th>执行时间</th><th>库存状态</th><th>出库入库</th>
    </tr>

    
	<?php if(is_array($stock)): foreach($stock as $key=>$vo): ?><tr>
          <td><input type="checkbox" name="gid" value="<?php echo ($vo["id"]); ?>" /></td><td><?php echo ($vo["num"]); ?></td> <td><?php echo ($vo["goods"]); ?></td>   <td><?php echo ($vo["money"]); ?></td>  <td><?php echo ($vo["filename"]); ?></td>   <td><?php echo (date('m/d/ H:i:s',$vo["time"])); ?></td>     
          <td><?php if($vo["stock"] == 1): ?>已入库<?php else: ?>已出库<?php endif; ?></td>     
          <td><?php if($vo["stock"] == 1): ?><a href='/index.php/Home/Stock/modstock1?id=<?php echo ($vo["id"]); ?>'>出库</a>
            <?php else: ?><a href='/index.php/Home/Stock/modstock2?id=<?php echo ($vo["id"]); ?>'>入库</a><?php endif; ?>
            <a href="/index.php/Home/Stock/updata?id=<?php echo ($vo["id"]); ?>">修改</a>
            <a href="/index.php/Home/Stock/delstock?id=<?php echo ($vo["id"]); ?>">删除</a></td> 
        </tr>
        <tr>  <td colspan=6>  <hr/> </td></tr><?php endforeach; endif; ?>
</table>
<!-- 全选 -->
<td colspan="5"><a href="javascript:void(0)" class="selectAll" >全选</a> / <a href="javascript:void(0)" class="revSelectAll" >反选</a>  / <a href="javascript:void(0)" class="delSelectAll">全不选</a>
</td>
<!-- 全选 -->
<!-- 提交删除ID -->
<form action="/index.php/Home/stock/batchdel" id="form" method="post">
          <input type="hidden" name="action" value="del" />
          <input type="hidden" name="gid" value="" />
          <input type="submit" value="删除选中数据" />
</form>
<!-- 提交删除ID -->
<!-- 分页 -->
                 <div class="page">
                        <p><?php echo ($show); echo ($count); ?></p>
                 </div>
<!--分页  -->
</div>

</body>
</html>